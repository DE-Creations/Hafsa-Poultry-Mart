<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Models\Invoice;
use Carbon\Carbon;
use domain\facades\CustomerFacade\CustomerFacade;
use domain\facades\InvoiceFacade\InvoiceFacade;
use Illuminate\Http\Request;

class InvoiceController extends ParentController
{
    public function index()
    {
        return view('pages.invoice.index');
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

    public function delete($invoice_id)
    {
        return InvoiceFacade::delete($invoice_id);
    }
}
