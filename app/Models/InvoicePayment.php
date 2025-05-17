<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'balance_forward',
        'paid',
        'memo',
        'paid_date',
        'date_added',
        'payment_method',
        'bank_acc_id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'id', 'invoice_id');
    }
    //our code
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'id', 'payment_method');
    }
    //our code
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'id', 'bank_acc_id');
    }
    //our code

    // public function invoice()
    // {
    //     return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    // }
    //AI code
    // public function paymentMethod()
    // {
    //     return $this->belongsTo(PaymentMethod::class, 'payment_method', 'id');
    // }
    //AI code
    // public function bankAccount()
    // {
    //     return $this->belongsTo(BankAccount::class, 'bank_acc_id', 'id');
    // }
    //AI code
}
