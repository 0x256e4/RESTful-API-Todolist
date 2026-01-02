<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Validasi register
    public function register_store(StoreRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'User berhasil terdaftar! ^^'
        ]);
    }

    // Validasi login
    public function login_store(StoreLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Login gagal, email atau password salah! ^^'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    // Logout dari dashboard
    public function logout_store()
    {
        Auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User berhasil logout! ^^'
        ]);
    }

    public function user_show()
    {
        $user = Auth()->user();

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'token' => [
                'type' => 'Bearer',
                'value' => $user->currentAccessToken()
            ],
        ]);
    }
}
