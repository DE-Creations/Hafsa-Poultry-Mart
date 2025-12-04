<?php

namespace App\Http\Controllers;

use App\Http\Requests\GRN\StoreGRNRequest;
use App\Models\Grn;
use domain\facades\GRNFacade\GRNFacade;
use domain\facades\SupplierFacade\SupplierFacade;
use Illuminate\Http\Request;

class GRNController extends ParentController
{
    public function index()
    {
        return view('pages.grn.index');
    }

    public function create()
    {
        $response['grn_date'] = now()->format('Y-m-d');
        $response['grn_number'] = Grn::generateGrnNumber();
        $response['suppliers'] = SupplierFacade::getSuppliers();
        $response['newGrnItems'] = GRNFacade::getSavedGrnItems();
        return view('pages.grn.create', $response);
    }

    public function loadGRNs(Request $request)
    {
        $query = Grn::query();

        if (isset($request['search'])) {
            $query = $query->where('code', 'like', '%' . $request['search'] . '%')
                ->orWhere('description', 'like', '%' . $request['search'] . '%')
                ->orWhere('note', 'like', '%' . $request['search'] . '%')
                ->orWhere('date', 'like', '%' . $request['search'] . '%')
                ->orWhere('amount', 'like', '%' . $request['search'] . '%');
        }

        if (isset($request['count'])) {
            $response['grns'] = $query->with(['supplier', 'grnPay'])->orderBy('id', 'desc')->paginate($request['count']);
        } else {
            $response['grns'] = $query->with(['supplier', 'grnPay'])->orderBy('id', 'desc')->paginate(20);
        }

        return view('pages.grn.components.table')->with($response);
    }

    public function store(StoreGRNRequest $request)
    {
        return GRNFacade::store($request->all());
    }

    public function edit($invoice_id)
    {
        $invoice = InvoiceFacade::get($invoice_id);
        return view('pages.invoice.edit')->with(['invoice' => $invoice]);
    }

    public function delete($grn_id)
    {
        return GRNFacade::delete($grn_id);
    }
}
