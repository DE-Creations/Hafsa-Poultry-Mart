<?php

namespace domain\facades\GRNFacade;

use domain\services\GRNService\GRNService;
use Illuminate\Support\Facades\Facade;

class GRNFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GRNService::class;
    }
}
