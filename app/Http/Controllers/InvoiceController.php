<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Models\Invoice;
use Carbon\Carbon;
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
        $response['date'] = Carbon::now()->format('Y-m-d');
        $response['invoice_no'] = Invoice::generateInvoiceNumber();
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
        // if ($request->hasFile('file')) {
        //     $file = $request->file('file');
        //     $fileName = time() . '.' . $file->extension();
        //     $file->move(public_path('storage/expenses'), $fileName);
        //     $request['file_path'] = 'storage/expenses/' . $fileName;
        // }
        return InvoiceFacade::store($request->all());
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
