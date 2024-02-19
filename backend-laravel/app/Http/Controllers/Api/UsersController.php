<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Laravel\Passport\PassportServiceProvider; 

class UsersController extends Controller
{
    public function register(Request $request){
        $request->validate([
            "name"=> "required|unique:users",
            "email"=> "required|email|unique:users",
            "password"=> "required|confirmed",
    ]);
        
    User::create([
        "name"=> $request->name,
        "email"=> $request->email,
        "password"=> Hash::make($request->password),
    ]);
    return response()->json([
        "status" => true,
        "message" => "User created"
    ]);
}

    public function login(Request $request) {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $token = JWTAuth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if(!empty($token)){
            return response() -> json ([
                "status" => true,
                "message"=> "Login successfully",
                "token" => $token
            ]);
        }  return response() -> json([
                "status"=> false,
                "message"=> "Invalid password or user",
            ]);

    }
    public function user() {
        $userData = auth()->user();

        return response() -> json([
            "status"=> true,
            "message"=> "Profile of User",
            "data"=> $userData
        ]);
    }
    
    public function refreshToken() {
        $newToken = auth()->refresh();

        return response() -> json([
            "status"=> true,
            "message"=> "New token was generated",
            "token"=> $newToken
        ]);
    }
    
    public function logout() {
        return response() -> json([
            "status"=> false,
            "message"=> "Logged out succesfully"
        ]);
    }

    public function delete() {
        
    }
}
