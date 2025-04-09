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

    public function update(array $data, $customer_id)
    {
        $customer = $this->customer->find($customer_id);
        return $customer->update($this->edit($customer, $data));
    }

    public function edit(Customer $customer, array $data)
    {
        return array_merge($customer->toArray(), $data);
    }

    public function delete($customer_id)
    {
        $customer = $this->customer->find($customer_id);
        return $customer->delete();
    }
}
