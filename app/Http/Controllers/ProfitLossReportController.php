<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Invoice;
use PDF;

class ProfitLossReportController extends Controller
{
    public function index()
    {
        $totalSales = Invoice::sum('sub_total');
        $totalExpenses = Expense::sum('amount');
        $net = $totalSales - $totalExpenses;

        return view('pages.reports.profit_loss.index', compact('totalSales', 'totalExpenses', 'net'));
    }

    public function print()
    {
        $totalSales = Invoice::sum('sub_total');
        $totalExpenses = Expense::sum('amount');
        $net = $totalSales - $totalExpenses;

        $pdf = PDF::loadView('print.pages.profit_loss.report', compact('totalSales', 'totalExpenses', 'net'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('profit_loss_report.pdf', ['Attachment' => false]);
    }
}
