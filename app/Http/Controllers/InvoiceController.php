<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Models\Invoice;
use Carbon\Carbon;
use domain\facades\CustomerFacade\CustomerFacade;
use domain\facades\InvoiceFacade\InvoiceFacade;
use domain\services\InvoiceService\InvoiceService;
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

        // get from BagsCategory
        $bags = [
            ['id' => 1, 'name' => 'Bag 1', 'unit_price' => 100],
            ['id' => 2, 'name' => 'Bag 2', 'unit_price' => 200],
            ['id' => 3, 'name' => 'Bag 3', 'unit_price' => 300],
            ['id' => 4, 'name' => 'Bag 4', 'unit_price' => 400],
            ['id' => 5, 'name' => 'Bag 5', 'unit_price' => 500],
        ];

        $response['bags'] = $bags;
        return view('pages.invoice.create', $response);
    }

    public function loadInvoices(Request $request)
    {
        $query = Invoice::query();

        // if (isset($request['search'])) {
        //     $query = $query->where('code', 'like', '%' . $request['search'] . '%')
        //         ->orWhere('description', 'like', '%' . $request['search'] . '%')
        //         ->orWhere('note', 'like', '%' . $request['search'] . '%')
        //         ->orWhere('date', 'like', '%' . $request['search'] . '%')
        //         ->orWhere('amount', 'like', '%' . $request['search'] . '%');
        // }

        if (isset($request['count'])) {
            $response['invoices'] = $query->orderBy('id', 'desc')->paginate($request['count']);
        } else {
            $response['invoices'] = $query->orderBy('id', 'desc')->paginate(20);
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
        $invoice = InvoiceFacade::get($invoice_id);
        return view('pages.invoice.edit')->with(['invoice' => $invoice]);
    }

    public function delete($invoice_id)
    {
        return InvoiceFacade::delete($invoice_id);
    }
}
