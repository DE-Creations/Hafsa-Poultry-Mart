<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ProfitLossReportController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $startDate = $validated['start_date'] ?? Carbon::today()->toDateString();
        $endDate = $validated['end_date'] ?? Carbon::today()->toDateString();

        $invoiceQuery = Invoice::query();
        $expenseQuery = Expense::query();

        if ($startDate && $endDate) {
            $invoiceQuery->whereBetween('date', [$startDate, $endDate]);
            $expenseQuery->whereBetween('date', [$startDate, $endDate]);
        }

        $totalSales = $invoiceQuery->sum('sub_total');
        $totalExpenses = $expenseQuery->sum('amount');
        $net = $totalSales - $totalExpenses;

        return view('pages.reports.profit_loss.index', compact('totalSales', 'totalExpenses', 'net', 'startDate', 'endDate'));
    }

    public function print(Request $request)
    {
        $validated = $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $startDate = $validated['start_date'] ?? Carbon::today()->toDateString();
        $endDate = $validated['end_date'] ?? Carbon::today()->toDateString();

        $invoiceQuery = Invoice::query();
        $expenseQuery = Expense::query();

        if ($startDate && $endDate) {
            $invoiceQuery->whereBetween('date', [$startDate, $endDate]);
            $expenseQuery->whereBetween('date', [$startDate, $endDate]);
        }

        $totalSales = $invoiceQuery->sum('sub_total');
        $totalExpenses = $expenseQuery->sum('amount');
        $net = $totalSales - $totalExpenses;

        $data = [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'totalSales' => $totalSales,
            'totalExpenses' => $totalExpenses,
            'net' => $net,
        ];

        $pdf = Pdf::loadView('print.pages.profit_loss.report', $data);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('profit_loss.pdf', ['Attachment' => false]);
    }
}
