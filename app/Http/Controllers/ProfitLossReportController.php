<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Invoice;

class ProfitLossReportController extends Controller
{
    public function index()
    {
        $totalSales = Invoice::sum('sub_total');
        $totalExpenses = Expense::sum('amount');
        $net = $totalSales - $totalExpenses;

        return view('pages.reports.profit_loss.index', compact('totalSales', 'totalExpenses', 'net'));
    }
}
