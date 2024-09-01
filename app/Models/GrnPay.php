<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrnPay extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'supplier_id',
        'grn_id',
        'account_id',
        'price',
        'status',
        'memo'
    ];

    public function grn()
    {
        return $this->belongsTo(Grn::class, 'grn_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function account()
    {
        return $this->belongsTo(BankAccount::class, 'account_id', 'id');
    }
}
