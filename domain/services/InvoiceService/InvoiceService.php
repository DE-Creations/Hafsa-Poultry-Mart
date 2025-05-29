<?php

namespace domain\services\InvoiceService;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\InvoicePayment;

class InvoiceService
{

    protected $invoice;
    protected $invoice_item;
    protected $invoice_payment;

    public function __construct()
    {
        $this->invoice = new Invoice();
        $this->invoice_item = new InvoiceItem();
        $this->invoice_payment = new InvoicePayment();
    }

    public function store(array $data)
    {
        // insert invoice
        $invoice_data['invoice_number'] = $data['invoice_number'];
        $invoice_data['date'] = $data['invoice_date'];
        $invoice_data['customer_id'] = $data['customer_id'];
        $invoice_data['subtotal'] = $data['subtotal'];
        $invoice_data['total'] = $data['total'];

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

        // insert invoice payments
        // 'invoice_id',
        // 'customer_id',
        // 'balance',
        // 'paid_amount',
        // 'invoice_total',
        // 'memo',
        // 'paid_date',
        // 'date_added',
        // 'payment_method',
        // 'bank_acc_id'

        return $created_invoice->id;
    }

    public function get($id)
    {
        return $this->expense->withTrashed()->findOrFail($id);
    }

    public function update($id, $data)
    {
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

    public function delete(int $expense_id)
    {
        $expense = $this->expense->find($expense_id);
        return $expense->delete();
    }

    public function restoreExpense(int $expense_id)
    {
        $deleted_expense = $this->expense->withTrashed()->find($expense_id);
        $deleted_expense->deleted_at = null;
        return $deleted_expense->save();
    }

    public function removeImage(int $id)
    {
        $details = $this->expense->find($id);
        $details->image_id = null;
        return $details->save();
    }

    public function calculateTotals($expenses)
    {
        $totals = [
            'total' => 0
        ];

        foreach ($expenses as $expense) {
            $totals['total'] += $expense['amount'];
        }

        return $totals;
    }

    public function newCategory(array $data)
    {
        $data['tenant_id'] = Auth::user()->tenant_id;
        $expense_category = $this->expense_category->where('name', $data['name'])->where('tenant_id', $data['tenant_id'])->first();
        if (!$expense_category) {
            return $this->expense_category->create($data);
        } else {
            return "This category already exists";
        }
    }

    public function getCategory($id)
    {
        return $this->expense_category->findOrFail($id);
    }

    public function updateCategory($id, $data)
    {
        $category = $this->expense_category->findOrFail($id);
        return $category->update($data);
    }

    public function deleteCategory(int $product_id)
    {
        return $this->expense_category->find($product_id)->delete();
    }

    public function categorySelectAll()
    {
        return $this->expense_category->where('tenant_id', Auth::user()->tenant_id)->orderBy('name', 'asc')->get();
    }
}
