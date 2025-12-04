<?php

namespace domain\services\DashboardService;

use App\Models\Expense;
use App\Models\Grn;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use Carbon\Carbon;
use domain\facades\CustomerFacade\CustomerFacade;

class DashboardService
{
    protected $invoice_payment;

    public function __construct()
    {
        $this->invoice_payment = new InvoicePayment();
    }

    public function getSalesInMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Get payments grouped by day
        $payments = InvoicePayment::selectRaw('DAY(invoice_date) as day, SUM(paid_amount) as total')
            ->whereBetween('invoice_date', [$startOfMonth, $endOfMonth])
            ->groupBy('day')
            ->orderBy('day', 'asc')
            ->get()
            ->keyBy('day');

        // dd($payments);

        // Create an array of totals for each day of the month
        $daysInMonth = Carbon::now()->daysInMonth;
        $totals = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $totals[] = isset($payments[$day]) ? (float) $payments[$day]->total : 0.0;
        }

        return $totals;
    }

    public function getMonthlySales()
    {
        $startOfYear = Carbon::parse(Carbon::now()->year . '-01-01')->startOfYear();
        $endOfYear = Carbon::parse(Carbon::now()->year . '-12-31')->endOfYear();

        // Fetch actual payments data and group by month
        $payments = InvoicePayment::selectRaw('YEAR(invoice_date) as year, MONTH(invoice_date) as month, MONTHNAME(invoice_date) as month_name, SUM(paid_amount) as total')
            ->whereBetween('invoice_date', [$startOfYear, $endOfYear])
            ->groupBy('year', 'month', 'month_name')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()
            ->keyBy('month');

        // Generate list of all months in the year
        $months = [];
        for ($month = 1; $month <= 12; $month++) {
            $months[] = [
                'month' => $month,
                'total' => 0,
            ];
        }

        // Merge the payments data with the list of all months
        foreach ($months as &$month) {
            if (isset($payments[$month['month']])) {
                $month['total'] = $payments[$month['month']]->total;
            }
        }

        // Extract only the totals into a simple array
        $totals = array_map(function ($month) {
            return $month['total'];
        }, $months);

        return $totals;
    }

    public function getGrnTotal()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

        return \DB::table('grn_items')
            ->join('grns', 'grn_items.grn_id', '=', 'grns.id')
            ->whereBetween('grns.date', [$startOfMonth, $endOfMonth])
            ->sum('grn_items.weight');
    }

    public function getPaymentsToCollect()
    {
        $payments = [];

        $customers = CustomerFacade::getCustomers();
        foreach ($customers as $customer) {
            if ($customer->id != 1) {
                $payment = InvoicePayment::where('customer_id', $customer->id)->orderBy('id', 'desc')->first();
                if ($payment != null && $payment->new_balance != 0) {
                    $payments[] = $payment;
                }
            }
        }

        return $payments;
    }

    public function getTotalSales()
    {
        $salesQuery = Invoice::query();
        $expensesQuery = Expense::query();

        $from = Carbon::now()->startOfMonth()->toDateString();
        $salesQuery->whereDate('date', '>=', $from);
        $expensesQuery->whereDate('date', '>=', $from);

        $to = Carbon::now()->endOfMonth()->toDateString();
        $salesQuery->whereDate('date', '<=', $to);
        $expensesQuery->whereDate('date', '<=', $to);

        $totalSales = $salesQuery->sum('sub_total');
        $totalExpenses = $expensesQuery->sum('amount');

        // include GRN payments in total expenses (use same date range)
        $grnPayments = Grn::whereDate('date', '>=', $from)
            ->whereDate('date', '<=', $to)
            ->sum('total');

        $totalExpenses += $grnPayments;

        return [
            'revenue' => $totalSales,
            'expenses' => $totalExpenses,
        ];
    }

    public function getNotifications()
    {
        $payments = [];

        $customers = CustomerFacade::getCustomers();
        foreach ($customers as $customer) {
            if ($customer->id != 1) {
                $oneWeekAgo = Carbon::now()->subWeek()->toDateString();
                $payment = InvoicePayment::where('customer_id', $customer->id)
                    ->whereDate('invoice_date', '<=', $oneWeekAgo)
                    ->orderBy('id', 'desc')
                    ->first();
                if ($payment != null && $payment->new_balance != 0) {
                    $payments[] = $payment;
                }
            }
        }

        return $payments;
    }
}
