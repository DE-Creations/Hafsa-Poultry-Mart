<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'method',
    ];

    public function grnpayment()
    {
        return $this->hasMany(GRNPay::class, 'payment_method_id', 'id');
    }

    public function invoicepayment()
    {
        return $this->hasMany(InvoicePayment::class, 'payment_method_id', 'id');
    }
}
