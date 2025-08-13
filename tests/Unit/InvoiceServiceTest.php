<?php

namespace Tests\Unit;

use domain\services\InvoiceService\InvoiceService;
use PHPUnit\Framework\TestCase;

class InvoiceServiceTest extends TestCase
{
    public function test_get_customer_balance_forward_handles_integer_and_string_ids()
    {
        $service = new InvoiceService();

        $this->assertSame(0, $service->getCustomerBalanceForward(1));
        $this->assertSame(0, $service->getCustomerBalanceForward("1"));
    }
}
