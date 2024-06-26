<?php

namespace App\Facades;

use App\services\UserService;
use Illuminate\Support\Facades\Facade;

class UserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserService::class;
    }
}
