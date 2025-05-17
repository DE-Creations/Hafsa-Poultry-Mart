<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grn extends Model
{
    use HasFactory;

    protected $fillable = [
        'grn_no',
        'supplier_id',
        'date',
        'delivary_address',
        'sub_total',
        'discount',
        'total',
        'is_paid',
    ];

    public function grnpay(){
        return $this->hasMany(GrnPay::class, 'id', 'grn_id');
    }

    public function grnitem(){
        return $this->hasMany(GrnItem::class,'id', 'grn_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }


}
