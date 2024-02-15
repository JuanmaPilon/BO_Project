<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    }
    
    public function user() {
    
    }
    
    public function refreshToken() {
    
    }
    
    public function logout() {
    
    }
}
