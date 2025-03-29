<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomersController extends ParentController
{
    public function index()
    {
        return view('pages.customers.index');
    }
}
