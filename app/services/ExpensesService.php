<?php

namespace App\services;

use Exception;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ExpenseCollection;

class ExpensesService{

    public function show()
    {
        try{
            $expenses = Expense::where('user_id',Auth::user()->id)->get();

            return response()->json(['success'=>true,'status'=>200,'data'=> new ExpenseCollection($expenses)]);

        }catch(Exception $e){

            return response()->json(['success'=>false,'status'=>500,'message'=>$e->getMessage()]);
        }
    }
}
