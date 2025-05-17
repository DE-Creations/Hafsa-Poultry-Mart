<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'date',
        'customer_id',
        'delivery_address',
        'subtotal',
        'discount',
        'total',
        'is_paid',
    ];

    public function invoiceItems(){
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
    }

    public function invoicePayments(){
        return $this->hasMany(InvoicePayment::class, 'invoice_id', 'id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'id', 'customer_id');
    }
    //our code

    // public function customer(){
    //     return $this->belongsTo(Customer::class, 'customer_id', 'id');
    // }
    //AI code
}
