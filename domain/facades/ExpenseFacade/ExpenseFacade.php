<?php

namespace domain\facades\ExpenseFacade;

use domain\services\ExpenseService\ExpenseService;
use Illuminate\Support\Facades\Facade;

class ExpenseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ExpenseService::class;
    }
}
