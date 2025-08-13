<?php

namespace domain\services\InvoiceService;

use App\Models\BagHistory;
use App\Models\BagsCategory;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\InvoicePayment;
use App\Models\OutputItem;
use App\Models\Stock;

class InvoiceService
{
    protected $invoice;
    protected $invoice_item;
    protected $invoice_payment;
    protected $output_item;
    protected $stock;

    protected $bags_category;
    protected $bags_history;

    public function __construct()
    {
        $this->invoice = new Invoice();
        $this->invoice_item = new InvoiceItem();
        $this->invoice_payment = new InvoicePayment();
        $this->output_item = new OutputItem();
        $this->stock = new Stock();

        $this->bags_category = new BagsCategory();
        $this->bags_history = new BagHistory();
    }

    function getSavedInvoiceItems()
    {
        $stocks = $this->stock->with('outputItem')->where('balance', '>', 0)->get();

        $result = [];
        foreach ($stocks as $stock) {
            $result[] = [
                'id' => $stock->id,
                'name' => $stock->outputItem->name,
                'name_id' => $stock->outputItem->id,
                'description' => $stock->outputItem->description,
                'unit_price' => $stock->unit_price,
                'balance' => $stock->balance,
                'stock_date' => $stock->updated_at->format('Y-m-d'),
            ];
        }

        return $result;
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
                    'stock_id' => $item['stock_id'],
                    'weight' => $item['weight'],
                    'unit_price' => $item['unit_price'],
                    'amount' => $item['amount'],
                ];
                $this->invoice_item->create($item_data);

                // update the stock table
                $stock = $this->stock->where('id', $item['stock_id'])->first();
                if ($stock) {
                    $stock->balance -= $item['weight'];
                    $stock->save();
                }
            }
        }

        // update the stock table
        // if (isset($data['items']) && is_array($data['items'])) {
        //     foreach ($data['items'] as $item) {
        //         $stock = $this->stock->where('output_item_id', $item['id'])->first();
        //         if ($stock) {
        //             $stock->balance -= $item['weight'];
        //             $stock->save();
        //         }
        //     }
        // }

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

        return $created_invoice->id;
    }

    public function getCustomerBalanceForward($customer_id)
    {
        if ($customer_id === "1") {
            return 0;
        } else {
            $last_payment = $this->invoice_payment->where('customer_id', $customer_id)->orderBy('id', 'desc')->first();
            if ($last_payment) {
                return $last_payment->new_balance;
            } else {
                return "none";
            }
        }
    }

    public function get($id)
    {
        return $this->invoice->with(['customer', 'invoicePayment', 'invoiceItems', 'bags'])->findOrFail($id);
    }

    public function delete(int $invoice_id, $restock = false)
    {
        // Delete invoice payment
        $invoice_payment = $this->invoice_payment->where('invoice_id', $invoice_id)->first();
        if ($invoice_payment) {
            $invoice_payment->delete();
        }

        // Get invoice items before deleting
        $invoice_items = $this->invoice_item->where('invoice_id', $invoice_id)->get();

        // Restock logic
        if ($restock) {
            foreach ($invoice_items as $item) {
                // Find the stock record by id (stock_id is the PK in stocks table)
                $stock = $this->stock->where('id', $item->stock_id)->first();
                if ($stock) {
                    $stock->balance += $item->weight;
                    $stock->save();
                }
            }
        }

        // Delete invoice items
        foreach ($invoice_items as $item) {
            $item->delete();
        }

        // Delete bags
        $bags = $this->bags_history->where('invoice_id', $invoice_id)->get();
        foreach ($bags as $bag) {
            $bag->delete();
        }

        // Delete invoice
        $invoice = $this->invoice->find($invoice_id);
        return $invoice ? $invoice->delete() : false;
    }

    public function update($data, $invoice_id)
    {
        $last_invoice = $this->invoice_payment->where('customer_id', $data['invoice']['customer_id'])
            ->orderBy('id', 'desc')
            ->first();
        if (!$last_invoice) {
            return 'This customer has no previous invoices.';
        } else {
            if ($last_invoice->invoice_id != $invoice_id) {
                return 'This invoice is not the last invoice of this customer. You cannot update it.';
            } else {
                $invoice = $this->invoice->find($invoice_id);
                $invoice->update($this->editInvoice($invoice, $data['invoice']));

                $invoice_payment = $this->invoice_payment->where('invoice_id', $invoice_id)->first();
                $invoice_payment->update($this->editPayment($invoice_payment, $data['invoice_payment']));

                // delete all invoice items and create new invoice items
                $invoice_items = $this->invoice_item->where('invoice_id', $invoice_id)->get();
                foreach ($invoice_items as $item) {
                    $item->delete();
                }
                if (isset($data['items']) && is_array($data['items'])) {
                    foreach ($data['items'] as $item) {
                        $item_data = [
                            'invoice_id' => $invoice_id,
                            'item_name' => $item['item_name'],
                            'weight' => $item['weight'],
                            'unit_price' => $item['unit_price'],
                            'amount' => $item['amount'],
                        ];
                        $this->invoice_item->create($item_data);
                    }
                }

                // delete all bags and create new bags
                $bags = $this->bags_history->where('invoice_id', $invoice_id)->get();
                foreach ($bags as $bag) {
                    $bag->delete();
                }
                if (isset($data['bags']) && is_array($data['bags'])) {
                    foreach ($data['bags'] as $bag) {
                        $bag_data = [
                            'bags_category_id' => $bag['id'],
                            'invoice_id' => $invoice_id,
                            'count' => $bag['count'],
                        ];
                        $this->bags_history->create($bag_data);
                    }
                }

                return 'Invoice updated successfully';
            }
        }
    }

    public function editInvoice(Invoice $invoice, array $data)
    {
        return array_merge($invoice->toArray(), $data);
    }

    public function editPayment(InvoicePayment $invoicePayment, array $data)
    {
        return array_merge($invoicePayment->toArray(), $data);
    }
}
