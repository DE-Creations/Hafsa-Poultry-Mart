<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use domain\facades\ExpenseFacade\ExpenseFacade;
use Illuminate\Http\Request;

class ExpenseReportController extends ParentController
{
    public function index()
    {
        $response['categories'] = ExpenseFacade::getExpensesCategories();
        return view('pages.reports.expense.index', $response);
    }

    public function loadReport(Request $request)
    {
        $from = $request['from_date'] ?? null;
        $to = $request['to_date'] ?? null;
        $expense_category_id = $request['expense_category_id'] ?? null;

        $query = Expense::query();

        if ($from) {
            $query->whereDate('date', '>=', $from);
        }
        if ($to) {
            $query->whereDate('date', '<=', $to);
        }
        if ($expense_category_id && $expense_category_id != 'select') {
            $query->where('expense_category_id', $expense_category_id);
        }

        // if (isset($request['count'])) {
        // $response['expenses'] = $query->with(['customer', 'invoicePayment'])->orderBy('id', 'desc')->paginate($request['count']);
        // } else {
        //     $response['expenses'] = $query->with(['customer', 'invoicePayment'])->orderBy('id', 'desc')->paginate(20);
        // }

        $response['expenses'] = $query->with(['expenseCategory'])->orderBy('id', 'desc')->get();

        return view('pages.reports.expense.components.table', $response);
    }
}
