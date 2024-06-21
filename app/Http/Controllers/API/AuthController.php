<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    //register
    public function register(Request $request){
        //Validation
        $request->validate([
            "name"=>"required|string",
            "email"=>"required|string|email|unique:users",
            "password"=>"required",
        ]);
        
        //User model to save user database
        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>bcrypt($request->password),
        ]);

        return response()->json([
            "status" => true, 
            "messege" => "Registrasi berhasil",
            "data"=>[]
        ]);
    }

    //Login
    public function login(Request $request){
        //Validation
        $request->validate([
            "email"=>"required",
            "password"=>"required",
        ]);

        //Auth Facade
        $token = Auth::attempt([
            "email"=> $request->email,
            "password"=> $request->password,
        ]);

        if (!$token) { 
            return response()->json([
                "status"=> false,
                "messege"=>"Invalid login details"
            ]);
        }

        return response()->json([
            "status"=> true,
            "messege"=> "User Logged in",
            "token"=> $token,
        ]);
    }

    //Profile
    public function profile(){

        $userData=auth()->user();

        return response()->json([
            "status"=>true,
            "messege"=>"Profile Data",
            "user"=>$userData,
            "user_id"=>request()->user()->id,
            "email"=>request()->user()->email,
        ]);
        
    }

    //Refresh Token
    public function refresh(){

        return response()->json([
            "user"=>Auth::user(),
            "authorisation"=>[
                "token"=>Auth::refresh(),
                "type"=>'bearer',
            ]
        ]);
    }

    //Logout
    public function logout(){
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
    
}
