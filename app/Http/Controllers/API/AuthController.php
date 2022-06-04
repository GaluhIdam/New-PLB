<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected $redirectTo = '/dashboard';
    //  Register Functions
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required', //
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
            'bio' => $request->bio,
            'avatar' => $request->avatar,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true, //
            'Messages' => 'Pendaftaran Berhasil dilakukan',
            'data' => $user
        ]);
    }

    // Login Functions
    public function login(Request $request)

    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Username tidak boleh kosong!',
                'password.required' => 'Password tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password yang anda masukan salah!',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login Berhasil!',
            'data'    => $user,
            'token'   => $user->createToken('authToken')->accessToken
        ]);
    }

    // Logout Functions
    public function logout(Request $request)
    {
        $removeToken = $request->user()->tokens()->delete();

        if ($removeToken) {
            return response()->json([
                'success' => true,
                'message' => 'Kamu telah berhasil keluar!',
            ]);
        }
    }
}
