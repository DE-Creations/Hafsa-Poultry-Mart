<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\StoreCustomerRequest;
use domain\facades\CustomerFacade\CustomerFacade;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomersController extends ParentController
{
    public function index()
    {
        $customers = CustomerFacade::getCustomers();
        return view('pages.customers.index', [
            'customers' => $customers,
        ]);
    }

    public function store(Request $request)
    {
        $customer_id = CustomerFacade::store($request->all());
        return redirect()->route('customers.index');
    }

    public function get($customer_id)
    {
        $customer = CustomerFacade::get($customer_id);
        return response()->json($customer);
    }

    public function update(Request $request, $customer_id)
    {
        return CustomerFacade::update($request->all(), $customer_id);
    }
}
