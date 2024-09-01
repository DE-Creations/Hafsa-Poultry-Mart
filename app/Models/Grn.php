<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grn extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'supplier_id',
        'serial',
        'date',
        'memo',
        'discount_rate',
        'discount_amount',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(GrnItem::class, 'grn_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(GrnPay::class, 'grn_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
