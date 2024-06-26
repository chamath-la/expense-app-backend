<?php

namespace App\Facades;

use App\services\ExpensesService;
use Illuminate\Support\Facades\Facade;

class ExpenseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ExpensesService::class;
    }
}
