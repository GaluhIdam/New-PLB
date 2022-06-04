<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image as Image;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isAdmin') || Gate::allows('isPlanner')) {
            return User::orderBy('id')->paginate(0);
        }
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

    public function profile()
    {
        return auth('api')->user();
    }
    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
        $this->validate(
            $request,
            [
                'name' => ['required', 'string', 'max:191'],
                'username' => ['required', 'string', 'max:191'],
                'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,' . $user->id],
                'password' => ['sometimes', 'required', 'min:8'],
                'role' => 'required',
                'description' => ['sometimes', 'max:255'],
            ],
            [
                'name.required'     => 'Nama tidak boleh kosong!',
                'username.required' => 'Username tidak boleh kosong!',
                'email.required'    => 'Alamat Email tidak boleh kosong!',
                'role.required' => 'Role Pengugna tidak boleh kosong!',
                'password.min' => 'Gunakan Minimal 8 karakter',
                'password.required' => 'Password tidak boleh kosong',
            ]
        );
        $currentPhoto = $user->photo;
        if ($request->photo != $currentPhoto) {
            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos(
                $request->photo,
                ';'
            )))[1])[1];
            Image::make($request->photo)->save(public_path('img/profile/') . $name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/') . $currentPhoto;
            if (file_exists($userPhoto)) {
                @unlink($userPhoto);
            }
        }

        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->$request->all();
        return ['message'  => 'Berhasil'];
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
                'role.required' => 'Role Pengugna tidak boleh kosong!',
            ]
        );
        $user->update($request->all());
        return ['message' => 'Berhasil memperbarui Pengguna'];
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

        return ['message' => 'Pengguna berhasil dihapus'];
    }
}
