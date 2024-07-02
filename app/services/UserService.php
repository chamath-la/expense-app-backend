<?php

namespace App\services;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService{

    public function login($request)
    {
        try{

            if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
                $user = User::where('username',$request->username)->first();
                $token= $user->createToken('token')->plainTextToken;
            }else{
                throw new Exception('crentials not correct');
            }


            return successResponse($token);

        }catch(Exception $e){

            return errorMessage('Check your Username and Password');
        }
    }

    public function register($request)
    {
        try{
            $register = User::create([
                'name'=>$request->name,
                'username'=>$request->username,
                'password'=>$request->password,
                'email'=>$request->email
            ]);

            return successMessage('User registered');

        }catch(Exception $e){

            return errorMessage($e);
        }
    }

    public function logout($request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['success'=>true,'status'=>200,'message'=>'User logout']);
    }
}
