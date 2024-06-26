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
    public function login(AuthRequest $request){ return userService::login($request); }

    public function register(UserRegisterRequest $request){ return userService::register($request);}

    public function logout(Request $request){  return userService::logout($request);}
}
