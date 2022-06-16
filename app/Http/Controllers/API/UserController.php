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
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    //     $users = DB::table('users')->count();
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return User::orderBy('id')->paginate(0);
        // if (Gate::allows('isAdmin') || Gate::allows('isPlanner')) {
        //     return User::orderBy('id')->paginate(0);
        // }
        $search = $request->get('search');

        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }

        $users = User::when($search,  function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('role', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhere('updated_at', 'like', '%' . $search . '%');
            });
        })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })
            ->paginate(10);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
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
                'role.required' => 'Role Pengugna tidak boleh kosong!',
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
        $this->authorize('isAdmin');
        // Hapus Pengguna
        $user = User::find($id);
        $user->delete();

        return ['message' => 'Successfully deleted'];
    }
}
