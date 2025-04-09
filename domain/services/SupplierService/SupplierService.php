<?php

namespace domain\services\SupplierService;
use App\Models\Supplier;
class SupplierService
{
    protected $supplier;

    public function __construct() {
    $this->supplier = new Supplier();
    }

    public function getSuppliers(){
        return $this->supplier->get();
    }

    public function store($details){
        $supplier_id = $this->supplier->create($details);
        return $supplier_id;
    }

    public function get($supplier_id){
        return $this->supplier->find($supplier_id);
    }

    public function update(array $data, $supplier_id){
        $supplier = $this->supplier->find($supplier_id);
        return $supplier->update($this->edit($supplier, $data));
    }

    public function edit(Supplier $supplier, array $data){
        return array_merge($supplier->toArray(), $data);
    }

    public function delete($supplier_id)
    {
        $supplier = $this->supplier->find($supplier_id);
        return $supplier->delete();
    }
}
?>