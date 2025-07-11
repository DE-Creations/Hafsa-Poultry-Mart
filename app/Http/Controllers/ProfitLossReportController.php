<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfitLossReportController extends Controller
{
    public function index()
    {
        return view('pages.reports.profit_loss.index');
    }
}
