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
}
