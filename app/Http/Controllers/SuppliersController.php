<?php

namespace App\Http\Controllers;

use domain\facades\SupplierFacade\SupplierFacade;
use Illuminate\Http\Request;


class SuppliersController extends ParentController
{
    public function index()
    {
        $suppliers = SupplierFacade::getSuppliers();
        return view('pages.suppliers.index', [
            'suppliers' => $suppliers,
        ]);
    }

    public function list()
    {
        $supplier = SupplierFacade::getSuppliers();
        return response()->json($supplier);
    }

    public function store(Request $request)
    {
        SupplierFacade::store($request->all());
        return redirect()->route('suppliers.index');
    }

    public function get($supplier_id)
    {
        $supplier = SupplierFacade::get($supplier_id);
        return response()->json($supplier);
    }

    public function update(Request $request, $supplier_id)
    {
        return SupplierFacade::update($request->all(), $supplier_id);
    }

    public function delete($supplier_id)
    {
        return SupplierFacade::delete($supplier_id);
    }
}
