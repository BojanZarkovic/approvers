<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Auth extends Controller
{

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        // check email
        if (is_null($user)) {
            return response()->json([
                'success' => false,
                'errors'  => 'Wrong email or password.'
            ], 401);
        }

        // check password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'errors'  => 'Wrong email or password.'
            ], 401);
        }

        // everything is OK send token
        $token = $user->createToken('auth_token');

        return response()->json(['token' => $token], 200);
    }
}
