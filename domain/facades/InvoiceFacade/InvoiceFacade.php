<?php

namespace domain\facades\InvoiceFacade;

use domain\services\InvoiceService\InvoiceService;
use Illuminate\Support\Facades\Facade;

class InvoiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return InvoiceService::class;
    }
}
