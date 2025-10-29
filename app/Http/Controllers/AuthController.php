<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    //------------- Login Handler --------------------------

    public function  handleLogin (Request $request){
    
        // input field validation
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if( !$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Invalid login credentials'
            ],422);
        } 
        
        else{
            // generate Auth token for user
            $token = $user->createToken($user->name .'Auth-token')->plainTextToken;
            return response()->json([
                'message' => 'Login Successful',
                'token_type' => 'Bearer',
                'token' => $token
                ],200);
        }

    }

//---------User Registration logic handler --------------------------
    public function handleRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
            'role'=> 'customer'
        ]);

        // generate a token for user
        $token = $user->createToken($user->name .'Auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Registration Successful',
            'token_type' => 'Bearer',
            'token' => $token
            ],201);
    }
}
