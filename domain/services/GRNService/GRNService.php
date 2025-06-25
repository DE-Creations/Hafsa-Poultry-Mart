<?php

namespace domain\services\GRNService;

use App\Models\Grn;
use App\Models\GrnItem;
use App\Models\GrnPay;
use App\Models\InvoiceGrnCalculation;

class GRNService
{
    protected $grn;
    protected $grn_item;
    protected $grn_payment;
    protected $invoice_grn_calculation;

    public function __construct()
    {
        $this->grn = new Grn();
        $this->grn_item = new GrnItem();
        $this->grn_payment = new GrnPay();
        $this->invoice_grn_calculation = new InvoiceGrnCalculation();
    }

    public function store(array $data)
    {
        // insert grn
        $grn_data = [
            'grn_number' => $data['grn_number'],
            'date' => $data['grn_date'],
            'supplier_id' => $data['supplier_id'],
            'sub_total' => $data['sub_total'],
        ];

        $created_grn = $this->grn->create($grn_data);
        $created_grn->save();

        // insert invoice items
        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $item) {
                $item_data = [
                    'grn_id' => $created_grn->id,
                    'weight' => $item['weight'],
                    'unit_price' => $item['unit_price'],
                    'amount' => $item['amount'],
                ];
                $this->grn_item->create($item_data);
            }
        }

        // insert invoice payments
        $payment_data = [
            'invoice_id' => $created_grn->id,
            'supplier_id' => $data['supplier_id'],
            'balance' => $data['balance'], // Assuming initial balance is the total amount
            'paid_amount' => $data['paid_amount'], // Initial paid amount is 0
            'invoice_total' => $data['total'],
            // 'memo' => isset($data['memo']) ? $data['memo'] : '',
            // 'paid_date' => null, // No payment made yet
            // 'date_added' => now(),
            // 'payment_method' => isset($data['payment_method']) ? $data['payment_method'] : null,
            // 'bank_acc_id' => isset($data['bank_acc_id']) ? $data['bank_acc_id'] : null,
        ];
        $this->grn_payment->create($payment_data);

        // update the grn_total with weight
        $total_grn_weight = 0;

        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $item) {
                $total_grn_weight += $item['weight'];
            }
        }

        $calculation = $this->invoice_grn_calculation->first();
        $data['grn_total'] = $calculation['grn_total'] + $total_grn_weight;
        $calculation->update($data);

        return $created_grn->id;
    }

    public function getCustomerBalanceForward($supplier_id)
    {
        $last_payment = $this->grn_payment->where('supplier_id', $supplier_id)->orderBy('id', 'desc')->first();
        if ($last_payment) {
            return $last_payment->balance;
        } else {
            return 0;
        }
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
