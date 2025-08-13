<?php

namespace domain\repositories;

use domain\facades\InvoiceFacade\InvoiceFacade;

class InvoiceRepository
{
    protected $service;

    public function __construct(InvoiceFacade $service)
    {
        $this->service = $service;
    }

    public function delete($invoice_id, $restock = false)
    {
        return $this->service->delete($invoice_id, $restock);
    }

    // ...existing methods...
}