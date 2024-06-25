<?php

namespace App\Http\Controllers;

use Exception;
use PgSql\Lob;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegisterRequest;

class UserController extends Controller
{
    public function login(AuthRequest $request)
    {
        try{

            if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
                $user = User::where('username',$request->username)->first();
                $token= $user->createToken('token')->plainTextToken;
            }else{
                throw new Exception('crentials not correct');
            }


            return response()->json(['success'=>true,'status'=>200,'data'=>$token]);

        }catch(Exception $e){

            return response()->json(['success'=>false,'status'=>500,'message'=>'Check your Username and Password']);
        }

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
