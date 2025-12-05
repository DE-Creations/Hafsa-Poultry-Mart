<?php

namespace domain\services\GRNService;

use App\Models\Grn;
use App\Models\GrnItem;
use App\Models\GrnPay;
use App\Models\InputItem;

class GRNService
{
    protected $grn;
    protected $grn_item;
    protected $grn_payment;
    protected $input_item;

    public function __construct()
    {
        $this->grn = new Grn();
        $this->grn_item = new GrnItem();
        $this->grn_payment = new GrnPay();
        $this->input_item = new InputItem();
    }

    function getSavedGrnItems()
    {
        $input_items = $this->input_item->get();
        $result = [];
        foreach ($input_items as $input_item) {
            $result[] = [
                'id' => $input_item->id,
                'name' => $input_item->name,
            ];
        }

        return $result;
    }

    public function store(array $data)
    {
        // insert grn
        $grn_data = [
            'grn_number' => $data['grn_number'],
            'date' => $data['grn_date'],
            'supplier_id' => $data['supplier_id'],
            'sub_total' => $data['sub_total'],
            'total' => $data['to_pay'],
        ];

        $created_grn = $this->grn->create($grn_data);
        $created_grn->save();

        // insert invoice items
        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $item) {
                $item_data = [
                    'grn_id' => $created_grn->id,
                    'item_name' => $item['item_name'],
                    'weight' => $item['weight'],
                    'unit_price' => $item['unit_price'],
                    'amount' => $item['amount'],
                ];
                $this->grn_item->create($item_data);
            }
        }

        // insert invoice payments
        $payment_data = [
            'grn_id' => $created_grn->id,
            'grn_date' => $data['grn_date'],
            'supplier_id' => $data['supplier_id'],
            'sub_total' => $data['sub_total'],
            'discount_amount' => $data['discount_amount'],
            'previous_balance_forward' => $data['previous_balance_forward'],
            'to_pay' => $data['to_pay'],
            'paid_amount' => $data['paid_amount'],
            'new_balance' => $data['new_balance'],
            'memo' => $data['memo'],
        ];
        $this->grn_payment->create($payment_data);

        return $created_grn->id;
    }

    public function delete(int $grn_id)
    {
        $grn = $this->grn->find($grn_id);
        return $grn->delete();
    }


    public function getSupplierBalanceForward($supplier_id)
    {
        $last_payment = $this->grn_payment->where('supplier_id', $supplier_id)->orderBy('id', 'desc')->first();
        if ($last_payment) {
            return $last_payment->new_balance;
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
