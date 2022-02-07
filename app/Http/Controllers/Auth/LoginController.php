<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * Basic Authentication Setup
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken(Auth::user()->name);
            return response()->json([
                'success' => 'Login Successful',
                'token' => $token->plainTextToken
            ]);
        } else {
            return response()->json([
                'error' => 'The provided credentials do not match our records.'
            ]);
        }
    }
}
