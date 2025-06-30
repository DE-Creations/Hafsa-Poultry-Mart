<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'date',
        'customer_id',
        'sub_total',
    ];

    protected $appends = [
        // 'customer',
        // 'invoice_payment',
    ];

    public static function generateInvoiceNumber()
    {
        $lastInvoice = Invoice::orderBy('id', 'desc')->withTrashed()->first();
        if ($lastInvoice) {
            $lastInvoiceNumber = $lastInvoice->invoice_number;
            $newInvoiceNumber = (int)str_replace('INV', '', $lastInvoiceNumber) + 1;
            return 'INV' . str_pad($newInvoiceNumber, 5, '0', STR_PAD_LEFT);
        }
        return 'INV00001';
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
    }

    public function invoicePayment()
    {
        return $this->hasMany(InvoicePayment::class, 'invoice_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    // public function getCustomerAttribute()
    // {
    //     return $this->customer_id ? Customer::find($this->customer_id) : null;
    // }

    // public function getInvoicePaymentAttribute()
    // {
    //     return $this->id ? InvoicePayment::where('invoice_id', $this->id)->first() : null;
    // }
}
