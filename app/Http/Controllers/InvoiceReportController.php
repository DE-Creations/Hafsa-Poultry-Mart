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
        // $from = $request['from_date'] ?? null;
        // $to = $request['to_date'] ?? null;
        // $customer = $request['customer'] ?? null;

        // $query = Invoice::query();

        // if ($from) {
        //     $query->whereDate('date', '>=', $from);
        // }
        // if ($to) {
        //     $query->whereDate('date', '<=', $to);
        // }
        // if ($customer && $customer != 'select') {
        //     $query->where('customer_id', $customer);
        // }

        // $invoices = $query->with(['customer', 'invoicePayment'])->orderBy('id', 'desc')->get();

        // if ($customer !== 'select') {
        //     $customerModel = CustomerFacade::get($customer);
        //     $customer = $customerModel->name;
        // }

        // $pdf = PDF::loadView('print.pages.invoice_report.report', compact('invoices', 'from', 'to', 'customer'));
        // $pdf->setPaper('A4', 'portrait');
        // return $pdf->stream("invoice.pdf");





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
        if ($customer && $customer != 'select' && $customer != '1') {
            $query->where('customer_id', $customer);
        }

        $invoices = $query->with(['customer', 'invoicePayment', 'invoiceItems.outputItem'])->orderBy('id', 'desc')->get();

        // $payments_data = $payload->get()->toArray();

        // $total_payment = array_sum(array_column($payments_data, 'price'));

        // Prepare the data to be passed to the PDF view
        // Prepare the data for multiple invoices (collection)
        $invoicesArray = $invoices->map(function ($inv) {
            return [
                'invoice_number' => $inv->invoice_number,
                'invoice_date' => $inv->date,
                'sub_total' => $inv->sub_total,
                'customer_name' => optional($inv->customer)->name,
                'invoicePayment' => $inv->invoicePayment ? $inv->invoicePayment->toArray() : [],
                'invoiceItems' => $inv->invoiceItems->map(function ($item) {
                    return [
                        'id' => $item->id ?? null,
                        'description' => $item->description ?? optional($item->outputItem)->name ?? null,
                        'output_item_name' => optional($item->outputItem)->name ?? null,
                        'qty' => $item->qty ?? null,
                        'price' => $item->price ?? null,
                        'total' => $item->total ?? null,
                    ];
                })->toArray(),
            ];
        })->toArray();

        $data = [
            'from' => $from,
            'to' => $to,
            'customer' => ($customer && $customer !== 'select') ? (CustomerFacade::get($customer)->name ?? $customer) : 'All',
            'invoices' => $invoicesArray,
        ];
        $data = (object) $data;

        // Generate the PDF 3 inch width
        $pdf = PDF::loadView('print.pages.invoice_report.report', compact('data'));
        $pdf->setPaper('A4', 'portrait');

        // If you want to download the PDF instead of displaying it in the browser, use:
        // return $pdf->download("invoice.pdf");
        // If you want to display the PDF in the browser, use:
        // return $pdf->stream("invoice.pdf");
        // If you want to display the PDF in the browser without downloading it, use:
        return $pdf->stream("invoice.pdf");
    }
}
