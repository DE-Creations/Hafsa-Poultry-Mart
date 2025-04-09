<?php

namespace domain\services\CustomerService;

use App\Models\Customer;

class CustomerService
{

    protected $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

    public function getCustomers()
    {
        return $this->customer->get();
    }

    public function store($details)
    {
        $customer_id = $this->customer->create($details);
        return $customer_id;
    }

    public function get($customer_id)
    {
        return $this->customer->find($customer_id);
    }
}
