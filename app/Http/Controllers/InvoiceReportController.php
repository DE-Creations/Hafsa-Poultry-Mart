<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use domain\facades\CustomerFacade\CustomerFacade;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class InvoiceReportController extends ParentController
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
        $customer = $request['customer'] ?? null;

        $query = Invoice::query();

        if ($from) {
            $query->whereDate('date', '>=', $from);
        }
        if ($to) {
            $query->whereDate('date', '<=', $to);
        }
        if ($customer && $customer != 'select') {
            $query->where('customer_id', $customer);
        }

        // if (isset($request['count'])) {
        // $response['invoices'] = $query->with(['customer', 'invoicePayment'])->orderBy('id', 'desc')->paginate($request['count']);
        // } else {
        //     $response['invoices'] = $query->with(['customer', 'invoicePayment'])->orderBy('id', 'desc')->paginate(20);
        // }

        $response['invoices'] = $query->with(['customer', 'invoicePayment'])->orderBy('id', 'desc')->get();

        return view('pages.reports.invoice.components.table', $response);
    }

    public function print(Request $request)
    {
        $from = $request['from_date'] ?? null;
        $to = $request['to_date'] ?? null;
        $customer = $request['customer'] ?? null;

        $query = Invoice::query();

        if ($from) {
            $query->whereDate('date', '>=', $from);
        }
        if ($to) {
            $query->whereDate('date', '<=', $to);
        }
        if ($customer && $customer != 'select') {
            $query->where('customer_id', $customer);
        }

        //$total = $query('sub_total');
        $invoices = $query->with(['customer', 'invoicePayment'])->orderBy('id', 'desc')->get();

        // $pdf = PDF::loadView('print.pages.invoice_report.report', compact('invoices', 'from', 'to', 'customer'));
        // $pdf->setPaper('A4', 'portrait');
        // return $pdf->stream('invoice.pdf', ['Attachment' => false]);

        $pdf = PDF::loadView('print.pages.invoice_report.report', compact('invoices', 'from', 'to', 'customer'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream("invoice.pdf");
    }
}
