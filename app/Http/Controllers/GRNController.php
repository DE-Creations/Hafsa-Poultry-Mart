<?php

namespace App\Http\Controllers;

use App\Models\Grn;
use Illuminate\Http\Request;

class GRNController extends ParentController
{
    public function index()
    {
        return view('pages.grn.index');
    }

    public function create()
    {
        $response['date'] = now()->format('Y-m-d');
        $response['grn_no'] = Grn::generateGrnNumber();
        return view('pages.grn.create');
    }

    public function loadGRNs(Request $request)
    {
        $query = Grn::query();

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

        return view('pages.grn.components.table')->with($response);
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
