<?php

namespace domain\facades\CustomerFacade;

use domain\services\CustomerService\CustomerService;
use Illuminate\Support\Facades\Facade;

class CustomerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CustomerService::class;
    }
}
