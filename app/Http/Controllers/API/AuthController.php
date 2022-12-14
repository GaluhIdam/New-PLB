<?php


namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\LoginHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;

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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'username' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
            ],
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => 'user',
            'description' => '-',
            'avatar' => 'default.png',
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
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
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Make Remember Me
        if ($request->remember_me) {
            Passport::personalAccessTokensExpireIn(now()->addDays(15));
        }

        $user = User::where('username', $request->username)->first();
        $token = $user->createToken('authToken')->plainTextToken;

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
            'token'   => $token,
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

    // User Profile
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
