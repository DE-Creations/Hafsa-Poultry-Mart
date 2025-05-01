<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Models\Supplier;
use domain\facades\SupplierFacade\SupplierFacade;
use Illuminate\Http\Request;


class SuppliersController extends ParentController
{
    public function index()
    {
        return view('pages.suppliers.index');
    }

    public function loadSuppliers(Request $request)
    {
        $query = Supplier::query();
        if(isset($request['search'])){
            $query = $query->where('id', 'like', '%' . $request['search'] . '%');
        }

        if(isset($request['count'])){
            $response['suppliers'] = $query->orderBy('id', 'desc')->paginate($request['count']);
        } else {
            $response['suppliers'] = $query->orderBy('id', 'desc')->paginate(20);
        }

        return view('pages.suppliers.components.table')->with($response);
    }

    public function list()
    {
        $supplier = SupplierFacade::getSuppliers();
        return response()->json($supplier);
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier_id = SupplierFacade::store($request->all());
        return redirect()->route('suppliers.index');
    }

    public function get($supplier_id)
    {
        $supplier = SupplierFacade::get($supplier_id);
        return response()->json($supplier);
    }

    public function update(UpdateSupplierRequest $request, $supplier_id)
    {
        return SupplierFacade::update($request->all(), $supplier_id);
    }

    public function delete($supplier_id)
    {
        return SupplierFacade::delete($supplier_id);
    }
}
