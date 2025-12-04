<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use domain\facades\DashboardFacade\DashboardFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends ParentController
{
    public function index()
    {
        return view('pages.dashboard.index', Auth::user());
    }

    public function dashboardDetails(Request $request)
    {
        $year = Carbon::now()->year;
        $days = [];
        $daysInMonth = Carbon::now()->daysInMonth;

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $days[] = $i;
        }

        $sales_in_month = DashboardFacade::getSalesInMonth();
        $monthly_sales = DashboardFacade::getMonthlySales();
        $grn_total = DashboardFacade::getGrnTotal();

        $data = [
            'month_dates' => $days,
            'year' => $year,
            'sales_in_month' => $sales_in_month,
            'monthly_sales' => $monthly_sales,
            'grnTotal' => $grn_total,
        ];

        return response()->json($data);
    }

    public function paymentsToCollect()
    {
        $response['payments'] = DashboardFacade::getPaymentsToCollect();
        return view('pages.dashboard.components.paymentTable')->with($response);
    }

    public function totalSales()
    {
        $data = DashboardFacade::getTotalSales();
        return response()->json($data);
    }

    public function notificationDetails()
    {
        $response['notifications'] = DashboardFacade::getNotifications();
        return view('layouts.notification')->with($response);
    }
}
