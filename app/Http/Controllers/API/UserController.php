<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image as Image;


class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        $users = DB::table('users')->count();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // if (Gate::allows('isAdmin')) {

        $search = $request->get('search');
        $search_id = $request->get('search_id');
        $search_username = $request->get('search_username');
        $search_email = $request->get('search_email');
        $search_role = $request->get('search_role');
        $search_created_at = $request->get('search_created_at');
        $search_updated_at = $request->get('search_updated_at');
        $search_description = $request->get('search_description');

        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'asc';
        }
        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        $users = User::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('role', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhere('updated_at', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        })
            ->when(
                $search_id,
                function ($query) use ($search_id) {
                    $query->where('id', 'like', '%' . $search_id . '%');
                },
            )
            ->when(
                $search_username,
                function ($query) use ($search_username) {
                    $query->where('username', 'like', '%' . $search_username . '%');
                },
            )
            ->when(
                $search_email,
                function ($query) use ($search_email) {
                    $query->where('email', 'like', '%' . $search_email . '%');
                },
            )
            ->when(
                $search_role,
                function ($query) use ($search_role) {
                    $query->where('role', 'like', '%' . $search_role . '%');
                },
            )
            ->when(
                $search_created_at,
                function ($query) use ($search_created_at) {
                    $query->where('created_at', 'like', '%' . $search_created_at . '%');
                },
            )
            ->when(
                $search_updated_at,
                function ($query) use ($search_updated_at) {
                    $query->where('updated_at', 'like', '%' . $search_updated_at . '%');
                },
            )
            ->when(
                $search_description,
                function ($query) use ($search_description) {
                    $query->where('description', 'like', '%' . $search_description . '%');
                },
            )
            ->when(($order && $by),
                function ($query) use ($order, $by) {
                    $query->orderBy($order, $by);
                },
            )
            ->paginate($paginate);

        $query_string = [
            'search' => $search,
            'search_id' => $search_id,
            'search_username' => $search_username,
            'search_email' => $search_email,
            'search_role' => $search_role,
            'search_created_at' => $search_created_at,
            'search_updated_at' => $search_updated_at,
            'search_description' => $search_description,
            'order' => $order,
            'by' => $by,
            'paginate' => $paginate,
        ];

        $users->appends($query_string);
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'name' => ['required', 'string', 'max:191'],
                'username' => ['required', 'string', 'max:191'],
                'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'role' => 'required',
                'description' => 'sometimes'
            ],
            [
                'name.required'     => 'Nama tidak boleh kosong!',
                'username.required' => 'Username tidak boleh kosong!',
                'email.required'    => 'Alamat Email tidak boleh kosong!',
                'password.required' => 'Password tidak boleh kosong!',
                'role.required' => 'Role Pengguna tidak boleh kosong!',
            ]
        );

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
            'description' => $request->description,
            'password' => Hash::make($request->password),
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['status' => true, 'user' => $user]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate(
            $request,
            [
                'name' => ['required', 'string', 'max:191'],
                'username' => ['required', 'string', 'max:191'],
                'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,' . $user->id],
                'password' => ['sometimes', 'min:8'],
                'role' => 'required',
            ],
            [
                'name.required'     => 'Nama tidak boleh kosong!',
                'username.required' => 'Username tidak boleh kosong!',
                'email.required'    => 'Alamat Email tidak boleh kosong!',
                'role.required' => 'Role Pengguna tidak boleh kosong!',
            ]
        );
        $user->update($request->all());
        return ['message' => 'Successfully updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('isAdmin');
        // Hapus Pengguna
        $user = User::find($id);
        $user->delete();

        return ['message' => 'Successfully deleted'];
    }
}
