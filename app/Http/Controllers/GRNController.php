<?php

namespace App\Http\Controllers;

use App\Http\Requests\GRN\StoreGRNRequest;
use App\Http\Requests\GRN\UpdateGRNRequest;
use App\Models\Grn;
use App\Models\InputItem;
use domain\facades\GRNFacade\GRNFacade;
use domain\facades\SupplierFacade\SupplierFacade;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class GRNController extends ParentController
{
    public function index()
    {
        return view('pages.grn.index');
    }

    public function view($grn_id)
    {
        $response['grn'] = GRNFacade::get($grn_id);
        $response['suppliers'] = SupplierFacade::getSuppliers();
        $response['newGrnItems'] = GRNFacade::getSavedGrnItemsForView($grn_id);
        // dd($response);
        return view('pages.grn.view', $response);
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

    public function getsupplierBalanceForward($supplier_id)
    {
        return GRNFacade::getSupplierBalanceForward($supplier_id);
    }

    public function edit($grn_id)
    {
        $response['grn'] = GRNFacade::get($grn_id);
        $response['suppliers'] = SupplierFacade::getSuppliers();
        $response['newGrnItems'] = GRNFacade::getSavedGrnItems($grn_id);
        $response['input_items'] = InputItem::all();
        return view('pages.grn.edit', $response);
    }

    public function update(UpdateGRNRequest $request, $grn_id)
    {
        return GRNFacade::update($request->all(), $grn_id);
    }

    public function delete($grn_id)
    {
        return GRNFacade::delete($grn_id);
    }

    public function print(Request $request, $grn_id)
    {
        $query = Grn::with(['supplier', 'grnPay', 'grnItems.inputItem'])->find($grn_id);
        // $payments_data = $payload->get()->toArray();

        // $total_payment = array_sum(array_column($payments_data, 'price'));

        // Prepare the data to be passed to the PDF view
        $data = [
            'grn_number' => $query->grn_number,
            'grn_date' => $query->date,
            'sub_total' => $query->sub_total,
            'supplier_name' => $query->supplier['name'],
            'grnPay' => $query->grnPay,
            'grnItems' => $query->grnItems,
        ];
        $data = (object) $data;

        // Generate the PDF 3 inch width
        $pdf = PDF::loadView('print.pages.grn.report', compact('data'));
        $pdf->setPaper('A4', 'portrait');

        // If you want to download the PDF instead of displaying it in the browser, use:
        // return $pdf->download("invoice.pdf");
        // If you want to display the PDF in the browser, use:
        // return $pdf->stream("invoice.pdf");
        // If you want to display the PDF in the browser without downloading it, use:
        return $pdf->stream("grn.pdf");
    }
}
