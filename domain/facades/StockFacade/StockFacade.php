<?php

namespace domain\facades\StockFacade;

use Illuminate\Support\Facades\Facade;
use domain\services\StockService\StockService;

class StockFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return StockService::class;
    }
}
