<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::orderBy('id')->paginate(0);
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
            ],
            [
                'name.required'     => 'Nama tidak boleh kosong!',
                'username.required' => 'Username tidak boleh kosong!',
                'email.required'    => 'Alamat Email tidak boleh kosong!',
                'password.required' => 'Password tidak boleh kosong!',
            ]
        );

        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'username' => $request['username'],
            'role' => $request['role'],
            'bio' => $request['bio'],
            'avatar' => $request['avatar'],
            'password' => Hash::make($request['password']),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Hapus Pengguna
        $user = User::find($id);
        $user->delete();

        return ['message' => 'Pengguna berhasil dihapus'];
    }
}
