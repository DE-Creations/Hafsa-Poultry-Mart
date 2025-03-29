<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends ParentController
{
    public function index()
    {
        return view('pages.dashboard', Auth::user());
    }
}
