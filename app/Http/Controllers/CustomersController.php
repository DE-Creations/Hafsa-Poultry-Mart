<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use domain\facades\CustomerFacade\CustomerFacade;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomersController extends ParentController
{
    public function index()
    {
        return view('pages.customers.index');
    }

    public function loadCustomers(Request $request)
    {
        $query = Customer::query();

        if (isset($request['search'])) {
            $query = $query->where('id', 'like', '%' . $request['search'] . '%')
                ->orWhere('name', 'like', '%' . $request['search'] . '%')
                ->orWhere('email', 'like', '%' . $request['search'] . '%')
                ->orWhere('mobile', 'like', '%' . $request['search'] . '%');
        }

        if (isset($request['count'])) {
            $response['customers'] = $query->orderBy('id', 'desc')->paginate($request['count']);
        } else {
            $response['customers'] = $query->orderBy('id', 'desc')->paginate(20);
        }

        return view('pages.customers.components.table')->with($response);
    }

    public function list()
    {
        $customers = CustomerFacade::getCustomers();
        return response()->json($customers);
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer_id = CustomerFacade::store($request->all());
        return redirect()->route('customers.index');
    }

    public function get($customer_id)
    {
        $customer = CustomerFacade::get($customer_id);
        return response()->json($customer);
    }

    public function update(UpdateCustomerRequest $request, $customer_id)
    {
        return CustomerFacade::update($request->all(), $customer_id);
    }

    public function delete($customer_id)
    {
        return CustomerFacade::delete($customer_id);
    }
}
