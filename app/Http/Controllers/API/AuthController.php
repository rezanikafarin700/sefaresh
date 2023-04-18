<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        auth()->attempt([
            'mobile' => $request->username,
            'password' => $request->password
       ]);

        if(auth()->check()){
            return response(['token' =>auth()->user()->generateToken()],200);
        }
        return response([
            'error' => 'اطلاعات کاربری اشتباه است'
        ],401);
    }

    public function logout(Request $request)
    {
       $user = auth('api')->user();
       $user->logout();
       return $user;
    }

    public function user()
    {
        return auth('api')->user();
    }
}
