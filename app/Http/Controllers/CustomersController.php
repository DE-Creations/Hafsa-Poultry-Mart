<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
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

    // public function all(Request $request){
    //     $query = Attendance::query()->where('tenant_id', Auth::user()->tenant_id)->orderBy('start_date_time', 'desc');

    //     $payload = $query->where(function ($query) use ($request) {
    //         if (isset($request->search_member)) {
    //             $query->where('member_id', $request->search_member['id']);
    //         }
    //         if (isset($request->search_package)) {
    //             $query->where('package_id', $request->search_package['id']);
    //         }
    //         if (isset($request->search_start_date_time)) {
    //             $query->whereDate('start_date_time', '>=', $request->search_start_date_time);
    //         }
    //     });

    //     $payload = QueryBuilder::for($query)
    //         ->allowedSorts(['id'])
    //         ->paginate(request('per_page', config('basic.pagination_per_page')));
    //     return AttendanceResource::collection($payload);
    // }

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
