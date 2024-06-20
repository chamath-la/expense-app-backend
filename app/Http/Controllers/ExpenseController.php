<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ExpenseResource;
use App\Http\Requests\addExpensesRequest;
use App\Http\Resources\ExpenseCollection;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $expenses = Expense::where('user_id',Auth::user()->id)->get();

            return response()->json(['success'=>true,'status'=>200,'data'=> new ExpenseCollection($expenses)]);

        }catch(Exception $e){

            return response()->json(['success'=>false,'status'=>500,'message'=>$e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(addExpensesRequest $request)
    {
        try{
            $expesnes=Expense::create([
                'description'=>$request->description,
                'user_id'=>Auth::user()->id,
                'amount'=>$request->amount,
                'status'=>$request->status,
            ]);

            if(!$expesnes){
                throw new Exception('error expenses not added');
            }

            return response()->json(['success'=>true,'status'=>200,'message'=>'Expense added']);

        }catch(Exception $e){

            return response()->json(['success'=>false,'status'=>500,'message'=>$e->getMessage()]);
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        try{

            if(!$expense){
                throw new Exception('No expenses for show');
            }

            return response()->json(['success'=>true,'status'=>200,'data'=> new ExpenseResource($expense)]);

        }catch(Exception $e){

            return response()->json(['success'=>false,'status'=>500,'message'=>$e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
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
