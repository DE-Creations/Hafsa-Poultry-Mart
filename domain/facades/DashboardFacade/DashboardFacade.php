<?php

namespace domain\facades\DashboardFacade;

use domain\services\DashboardService\DashboardService;
use Illuminate\Support\Facades\Facade;

class DashboardFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DashboardService::class;
    }
}
