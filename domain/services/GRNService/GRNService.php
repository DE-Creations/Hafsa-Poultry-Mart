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

    function getSavedGrnItemsForView($grn_id)
    {
        $grn_items = $this->grn_item->with('inputItem')->where('grn_id', $grn_id)->get();
        $result = [];
        foreach ($grn_items as $grn_item) {
            $result[] = [
                'id' => $grn_item->id,
                'name' => $grn_item->inputItem ? $grn_item->inputItem->name : ($grn_item->item_name ?? null),
                'weight' => $grn_item->weight,
                'unit_price' => $grn_item->unit_price,
                'amount' => $grn_item->amount
            ];
        }
        return $result;
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
        return $this->grn->with(['supplier', 'grnPay', 'grnItems'])->findOrFail($id);
    }

    public function update($data, $grn_id)
    {
        $last_grn = $this->grn_payment->where('supplier_id', $data['grn']['supplier_id'])
            ->orderBy('id', 'desc')
            ->first();
        if (!$last_grn) {
            return 'This supplier has no previous GRNs.';
        } else {
            if ($last_grn->grn_id != $grn_id) {
                return 'This GRN is not the last GRN of this supplier. You cannot update it.';
            } else {
                $grn = $this->grn->find($grn_id);
                $grn->update($this->editGRN($grn, $data['grn']));

                $grn_payment = $this->grn_payment->where('grn_id', $grn_id)->first();
                $grn_payment->update($this->editPayment($grn_payment, $data['grn_payment']));

                // delete all invoice items and create new invoice items
                // $invoice_items = $this->invoice_item->where('invoice_id', $invoice_id)->get();
                // foreach ($invoice_items as $item) {
                //     $item->delete();
                // }
                // if (isset($data['items']) && is_array($data['items'])) {
                //     foreach ($data['items'] as $item) {
                //         $item_data = [
                //             'invoice_id' => $invoice_id,
                //             'item_name' => $item['item_name'],
                //             'weight' => $item['weight'],
                //             'unit_price' => $item['unit_price'],
                //             'amount' => $item['amount'],
                //         ];
                //         $this->invoice_item->create($item_data);
                //     }
                // }

                // delete all bags and create new bags
                return 'GRN updated successfully';
            }
        }
    }

    public function editGRN(Grn $grn, array $data)
    {
        return array_merge($grn->toArray(), $data);
    }

    public function editPayment(GrnPay $grnPayment, array $data)
    {
        return array_merge($grnPayment->toArray(), $data);
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
}
