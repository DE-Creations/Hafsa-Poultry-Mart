<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GRNController extends ParentController
{
    public function index()
    {
        return view('pages.grn.index');
    }

    public function add()
    {
        return view('pages.grn.create-grn');
    }
}
