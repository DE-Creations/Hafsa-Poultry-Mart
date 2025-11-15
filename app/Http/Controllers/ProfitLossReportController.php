<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Invoice;
use Illuminate\Http\Request;
use PDF;

class ProfitLossReportController extends ParentController
{
    public function index()
    {
        return view('pages.reports.profit_loss.index');
    }

    public function loadReport(Request $request)
    {
        $from = $request['from_date'] ?? null;
        $to = $request['to_date'] ?? null;

        $salesQuery = Invoice::query();
        $expensesQuery = Expense::query();

        if ($from) {
            $salesQuery->whereDate('date', '>=', $from);
            $expensesQuery->whereDate('date', '>=', $from);
        }
        if ($to) {
            $salesQuery->whereDate('date', '<=', $to);
            $expensesQuery->whereDate('date', '<=', $to);
        }

        $response['totalSales'] = $salesQuery->sum('sub_total');
        $response['totalExpenses'] = $expensesQuery->sum('amount');
        $response['net'] = $response['totalSales'] - $response['totalExpenses'];

        return view('pages.reports.profit_loss.components.table')->with($response);
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
