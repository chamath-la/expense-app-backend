<?php

namespace App\Http\Controllers;

use Exception;
use PgSql\Lob;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegisterRequest;
use userService;

class UserController extends Controller
{
    public function login(AuthRequest $request)
    {
        return userService::login($request);

    }

    public function register(UserRegisterRequest $request)
    {
        try{
            $register = User::create([
                'name'=>$request->name,
                'username'=>$request->username,
                'password'=>$request->password,
                'email'=>$request->email
            ]);

            return response()->json(['success'=>true,'status'=>200,'message'=>'User registered']);

        }catch(Exception $e){

            return response()->json(['success'=>false,'status'=>500,'message'=>$e]);
        }

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['success'=>true,'status'=>200,'message'=>'User logout']);
    }
}
