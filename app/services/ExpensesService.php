<?php

namespace App\services;

use Exception;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\ExpenseCollection;

class ExpensesService{

    public function all()
    {
        try{
            $expenses = Expense::where('user_id',Auth::user()->id)->get();

            return successResponse(new ExpenseCollection($expenses));

        }catch(Exception $e){

            return errorMessage($e->getMessage());
        }
    }

    public function insert($request)
    {
        try{
            $expesnes=Expense::create([
                'name'=>$request->name,
                'date'=>$request->date,
                'description'=>$request->description,
                'user_id'=>Auth::user()->id,
                'amount'=>$request->amount,
                'status'=>$request->status,
            ]);

            if(!$expesnes){
                throw new Exception('error expenses not added');
            }

            return successMessage('Expense added');

        }catch(Exception $e){

            return errorMessage($e->getMessage());
        }
    }

    public function show($expense){
        try{

            if(!$expense){
                throw new Exception('No expenses for show');
            }

            return response()->json(['success'=>true,'status'=>200,'data'=> new ExpenseResource($expense)]);

        }catch(Exception $e){

            return response()->json(['success'=>false,'status'=>500,'message'=>$e->getMessage()]);
        }
    }

    public function update($request,$expense)
    {
        try{
            $expenses = Expense::find($expense->id);
            $expenses->description = $request->description;
            $expenses->amount = $request->amount;
            $expenses->status = $request->status;
            $expenses->update();


            if(!$expenses){
                throw new Exception('error expenses not updated');
            }

            return response()->json(['success'=>true,'status'=>200,'message'=>'Expenses updated']);

        }catch(Exception $e){

            return response()->json(['success'=>false,'status'=>500,'message'=>$e->getMessage()]);
        }
    }

    public function delete($expense)
    {
        try{
            $expenses = Expense::destroy($expense->id);

            if(!$expenses){
                throw new Exception('error expenses not deleted');
            }

            return response()->json(['success'=>true,'status'=>200,'message'=>'Expenses deleted']);

        }catch(Exception $e){

            return response()->json(['success'=>false,'status'=>500,'message'=>$e->getMessage()]);
        }
    }
}
