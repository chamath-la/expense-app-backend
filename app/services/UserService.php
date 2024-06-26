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
}
