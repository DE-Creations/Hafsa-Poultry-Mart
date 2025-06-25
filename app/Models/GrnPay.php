<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrnPay extends Model
{
    use HasFactory;

    protected $fillable = [
        'grn_id',
        'grn_date',
        'supplier_id',
        'sub_total',
        'discount_amount',
        'previous_balance_forward',
        'to_pay',
        'paid_amount',
        'new_balance',
        'memo',
    ];

    public function grn()
    {
        return $this->belongsTo(Grn::class, 'id', 'grn_id');
    }
    //our code
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'id', 'payment_method_id');
    }
    //our code
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'id', 'bank_acc_id');
    }
    //our code

    // public function grn()
    // {
    //     return $this->belongsTo(Grn::class, 'grn_id', 'id');
    // }
    //AI code
    // public function paymentMethod()
    // {
    //     return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    // }
    //AI code
    // public function bankAccount()
    // {
    //     return $this->belongsTo(BankAccount::class, 'bank_acc_id', 'id');
    // }
    //AI code
}
