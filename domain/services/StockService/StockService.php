<?php

namespace domain\services\StockService;

use App\Models\OutputItem;
use App\Models\Stock;

class StockService
{

    protected $stock;
    protected $output_item;

    public function __construct()
    {
        $this->stock = new Stock();
        $this->output_item = new OutputItem();
    }

    public function getOutputItems()
    {
        return $this->output_item->get();
    }

    public function store($details)
    {
        $stock_id = $this->stock->create($details);
        return $stock_id;
    }

    // public function get($customer_id)
    // {
    //     return $this->customer->find($customer_id);
    // }

    // public function update(array $data, $customer_id)
    // {
    //     $customer = $this->customer->find($customer_id);
    //     return $customer->update($this->edit($customer, $data));
    // }

    // public function edit(Customer $customer, array $data)
    // {
    //     return array_merge($customer->toArray(), $data);
    // }

    // public function delete($customer_id)
    // {
    //     $customer = $this->customer->find($customer_id);
    //     return $customer->delete();
    // }
}
