<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends ParentController
{
    public function index()
    {
        return view('pages.invoice.index');
    }

    public function create()
    {
        return view('pages.invoice.create');
    }
}
