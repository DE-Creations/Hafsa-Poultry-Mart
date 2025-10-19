<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use domain\facades\CustomerFacade\CustomerFacade;
use Illuminate\Http\Request;

class InvoiceReportController extends Controller
{
    public function index()
    {
        $response['customers'] = CustomerFacade::getCustomers();
        return view('pages.reports.invoice.index', $response);
    }

    public function loadReport(Request $request)
    {
        $from = $request['from_date'] ?? null;
        $to = $request['to_date'] ?? null;

        $query = Invoice::query();

        if ($from) {
            $query->whereDate('date', '>=', $from);
        }
        if ($to) {
            $query->whereDate('date', '<=', $to);
        }

        // if (isset($request['count'])) {
        // $response['invoices'] = $query->with(['customer', 'invoicePayment'])->orderBy('id', 'desc')->paginate($request['count']);
        // } else {
        //     $response['invoices'] = $query->with(['customer', 'invoicePayment'])->orderBy('id', 'desc')->paginate(20);
        // }

        $response['invoices'] = $query->with(['customer', 'invoicePayment'])->orderBy('id', 'desc')->get();

        return view('pages.reports.invoice.components.table', $response);
    }
}
