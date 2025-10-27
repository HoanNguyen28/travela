<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Login;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $user = Login::where('username', $request->username_regis)
                     ->orWhere('email', $request->email)
                     ->first();

        if ($user) {
            return response()->json(['success' => false]);
        }

        Login::create([
            'username' => $request->username_regis,
            'email' => $request->email,
            'password' => md5($request->password_regis)
        ]);

        return response()->json(['success' => true]);
    }

    public function login(Request $request)
    {
        $user = Login::where('username', $request->username)->first();

        if ($user && $user->password === md5($request->password)) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
