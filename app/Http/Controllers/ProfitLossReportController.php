<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Grn;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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

    public function print(Request $request)
    {

        $from = $request['from_date'] ?? null;
        $to = $request['to_date'] ?? null;

        $totalSalesQuery = Invoice::query();
        if ($from) {
            $totalSalesQuery->whereDate('date', '>=', $from);
        }
        if ($to) {
            $totalSalesQuery->whereDate('date', '<=', $to);
        }
        $totalSales = $totalSalesQuery->sum('sub_total');

        $totalExpensesQuery = Expense::query();
        if ($from) {
            $totalExpensesQuery->whereDate('date', '>=', $from);
        }
        if ($to) {
            $totalExpensesQuery->whereDate('date', '<=', $to);
        }
        $totalExpenses = $totalExpensesQuery->sum('amount');

        $totalGrnQuery = Grn::query();
        if ($from) {
            $totalGrnQuery->whereDate('date', '>=', $from);
        }
        if ($to) {
            $totalGrnQuery->whereDate('date', '<=', $to);
        }
        $totalGrn = $totalGrnQuery->sum('amount');

        $net = $totalSales - $totalExpenses - $totalGrn;

        $pdf = PDF::loadView('print.pages.profit_loss.report', compact('totalSales', 'totalExpenses', 'net', 'from', 'to'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('profit_loss_report.pdf', ['Attachment' => false]);
    }
}
