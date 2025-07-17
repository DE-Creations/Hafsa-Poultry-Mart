<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Models\Invoice;
use Carbon\Carbon;
use domain\facades\CustomerFacade\CustomerFacade;
use domain\facades\InvoiceFacade\InvoiceFacade;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends ParentController
{
    public function index()
    {
        return view('pages.invoice.index');
    }

    public function view($invoice_id)
    {
        $response['invoice'] = InvoiceFacade::get($invoice_id);
        $response['customers'] = CustomerFacade::getCustomers();
        $response['newInvoiceItems'] = InvoiceFacade::getSavedInvoiceItems();
        $response['bags'] = InvoiceFacade::getBagsCategory();
        return view('pages.invoice.view', $response);
    }

    public function create()
    {
        $response['invoice_date'] = Carbon::now()->format('Y-m-d');
        $response['invoice_number'] = Invoice::generateInvoiceNumber();
        $response['customers'] = CustomerFacade::getCustomers();
        $response['newInvoiceItems'] = InvoiceFacade::getSavedInvoiceItems();
        $response['bags'] = InvoiceFacade::getBagsCategory();
        return view('pages.invoice.create', $response);
    }

    public function loadInvoices(Request $request)
    {
        $query = Invoice::query();

        if (isset($request['search'])) {
            $query = $query->where('invoice_number', 'like', '%' . $request['search'] . '%')
                ->orWhereHas('customer', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request['search'] . '%');
                })
                ->orWhere('date', 'like', '%' . $request['search'] . '%');
        }

        if (isset($request['count'])) {
            $response['invoices'] = $query->with(['customer', 'invoicePayment'])->orderBy('id', 'desc')->paginate($request['count']);
        } else {
            $response['invoices'] = $query->with(['customer', 'invoicePayment'])->orderBy('id', 'desc')->paginate(20);
        }

        return view('pages.invoice.components.table')->with($response);
    }

    public function store(StoreInvoiceRequest $request)
    {
        return InvoiceFacade::store($request->all());
    }

    public function getCustomerBalanceForward($customer_id)
    {
        return InvoiceFacade::getCustomerBalanceForward($customer_id);
    }

    public function edit($invoice_id)
    {
        $response['invoice'] = InvoiceFacade::get($invoice_id);
        $response['customers'] = CustomerFacade::getCustomers();
        $response['newInvoiceItems'] = InvoiceFacade::getSavedInvoiceItems();
        $response['bags'] = InvoiceFacade::getBagsCategory();
        return view('pages.invoice.edit', $response);
    }

    public function update(UpdateInvoiceRequest $request, $invoice_id)
    {
        return InvoiceFacade::update($request->all(), $invoice_id);
    }

    public function delete($invoice_id)
    {
        return InvoiceFacade::delete($invoice_id);
    }

    public function print(Request $request, $invoice_id)
    {
        $query = Invoice::with(['customer', 'invoicePayment', 'invoiceItems', 'bags'])->find($invoice_id);

        // $payments_data = $payload->get()->toArray();

        // $total_payment = array_sum(array_column($payments_data, 'price'));

        // Prepare the data to be passed to the PDF view
        $data = [
            // 'member' => $memberName,
            // 'type' => $typeName,
            // 'search_details_from_date' => $search_details_from_date,
            // 'search_details_to_date' => $search_details_to_date,
            // 'payments_data' => $payments_data,
            // 'total_payment' => $total_payment,
            'details' => $query,
        ];

        // dd($data['details']['invoiceItems']);

        // Generate the PDF 3 inch width
        $pdf = PDF::loadView('print.pages.invoice.report', $data);
        $pdf->setPaper([0, 0, 226.77, 500], 'portrait');    // Width: 80mm (226.77pt), Height: 500pt (adjust as needed)

        // If you want to download the PDF instead of displaying it in the browser, use:
        // return $pdf->download("invoice.pdf");
        // If you want to display the PDF in the browser, use:
        // return $pdf->stream("invoice.pdf");
        // If you want to display the PDF in the browser without downloading it, use:
        return $pdf->stream("invoice.pdf", ["Attachment" => false]);
    }
}
