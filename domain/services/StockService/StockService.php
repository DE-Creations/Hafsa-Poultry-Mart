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

    public function get($stock_id)
    {
        return $this->stock->find($stock_id);
    }

    public function update(array $data, $stock_id)
    {
        $stock = $this->stock->find($stock_id);
        return $stock->update($this->edit($stock, $data));
    }

    public function edit(Stock $stock, array $data)
    {
        return array_merge($stock->toArray(), $data);
    }

    public function delete($stock_id)
    {
        $stock = $this->stock->find($stock_id);
        return $stock->delete();
    }
}
