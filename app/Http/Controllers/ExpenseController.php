<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ExpenseResource;
use App\Http\Requests\addExpensesRequest;
use App\Http\Resources\ExpenseCollection;
use expenses;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){ return expenses::all(); }

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
    public function store(addExpensesRequest $request){ return expenses::insert($request);}

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense){ return expenses::show($expense); }

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
    public function update(Request $request, Expense $expense){ return expenses::update($request,$expense);}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense){ return expenses::delete($expense);}
}
