<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpensesController extends ParentController
{
    public function index()
    {
        return view('pages.expenses.index');
    }
}
