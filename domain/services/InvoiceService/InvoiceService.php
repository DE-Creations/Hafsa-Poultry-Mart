<?php

namespace domain\services\InvoiceService;

use App\Models\BagHistory;
use App\Models\BagsCategory;
use App\Models\Invoice;
use App\Models\InvoiceGrnCalculation;
use App\Models\InvoiceItem;
use App\Models\InvoicePayment;
use App\Models\OutputItem;

class InvoiceService
{
    protected $invoice;
    protected $invoice_item;
    protected $invoice_payment;
    protected $output_item;
    protected $invoice_grn_calculation;

    protected $bags_category;
    protected $bags_history;

    public function __construct()
    {
        $this->invoice = new Invoice();
        $this->invoice_item = new InvoiceItem();
        $this->invoice_payment = new InvoicePayment();
        $this->output_item = new OutputItem();
        $this->invoice_grn_calculation = new InvoiceGrnCalculation();

        $this->bags_category = new BagsCategory();
        $this->bags_history = new BagHistory();
    }

    function getSavedInvoiceItems()
    {
        return $this->output_item->get();
    }

    function getBagsCategory()
    {
        return $this->bags_category->get();
    }

    public function store(array $data)
    {
        // insert invoice
        $invoice_data = [
            'invoice_number' => $data['invoice_number'],
            'date' => $data['invoice_date'],
            'customer_id' => $data['customer_id'],
            'sub_total' => $data['sub_total'],
        ];

        $created_invoice = $this->invoice->create($invoice_data);
        $created_invoice->save();

        // insert invoice items
        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $item) {
                $item_data = [
                    'invoice_id' => $created_invoice->id,
                    'item_name' => $item['item_name'],
                    'description' => $item['description'],
                    'weight' => $item['weight'],
                    'unit_price' => $item['unit_price'],
                    'amount' => $item['amount'],
                ];
                $this->invoice_item->create($item_data);
            }
        }

        // insert bags count
        if (isset($data['bags']) && is_array($data['bags'])) {
            foreach ($data['bags'] as $bag) {
                $bag_data = [
                    'bags_category_id' => $bag['id'],
                    'invoice_id' => $created_invoice->id,
                    'count' => $bag['count'],
                ];
                $this->bags_history->create($bag_data);
            }
        }

        // insert invoice payments
        $payment_data = [
            'invoice_id' => $created_invoice->id,
            'invoice_date' => $data['invoice_date'],
            'customer_id' => $data['customer_id'],
            'sub_total' => $data['sub_total'],
            'discount_amount' => $data['discount_amount'],
            'previous_balance_forward' => $data['previous_balance_forward'],
            'to_pay' => $data['to_pay'],
            'paid_amount' => $data['paid_amount'],
            'new_balance' => $data['new_balance'],
            'memo' => $data['memo'],
        ];
        $this->invoice_payment->create($payment_data);

        // update the invoice_total with weight
        $total_invoice_weight = 0;

        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $item) {
                $total_invoice_weight += $item['weight'];
            }
        }

        $calculation = $this->invoice_grn_calculation->first();
        $data['invoice_total'] = $calculation['invoice_total'] + $total_invoice_weight;
        $calculation->update($data);

        return $created_invoice->id;
    }

    public function getCustomerBalanceForward($customer_id)
    {
        if ($customer_id === "1") {
            return 0;
        } else {
            $last_payment = $this->invoice_payment->where('customer_id', $customer_id)->orderBy('id', 'desc')->first();
            if ($last_payment) {
                // dd($last_payment);
                return $last_payment->new_balance;
            } else {
                return "none";
            }
        }
    }

    public function get($id)
    {
        return $this->invoice->with(['customer', 'invoicePayment', 'invoiceItems'])->withTrashed()->findOrFail($id);
    }

    public function delete(int $invoice_id)
    {
        $invoice = $this->invoice->find($invoice_id);
        return $invoice->delete();
    }

    public function update($id, $data)
    {
        dd($data);
        $dateString = $data['date'];
        $formattedDate = Carbon::parse($dateString);

        if (isset($data['date'])) {
            $data['date'] = $formattedDate;
            $data['created_at'] = $formattedDate;
        }
        $expense = $this->expense->findOrFail($id);
        $expense->update($data);
        $expense->created_at = $expense->date;
        $expense->save();
        return $expense;
    }
}
