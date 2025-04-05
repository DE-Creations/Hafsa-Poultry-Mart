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

    public function edit(Request $request): View
    {
        return view('customers.edit', [
            'customers' => $request->customers(),
        ]);
    }
}
