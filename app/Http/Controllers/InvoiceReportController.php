<?php

namespace App\Http\Controllers;

use domain\facades\CustomerFacade\CustomerFacade;

class InvoiceReportController extends Controller
{
    public function index()
    {
        $response['customers'] = CustomerFacade::getCustomers();
        return view('pages.reports.invoice.index', $response);
    }
}
