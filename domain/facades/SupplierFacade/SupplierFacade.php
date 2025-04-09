<?php

namespace domain\facades\SupplierFacade;
use Illuminate\Support\Facades\Facade;
use domain\services\SupplierService\SupplierService;

class SupplierFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SupplierService::class;
    }
}
?>