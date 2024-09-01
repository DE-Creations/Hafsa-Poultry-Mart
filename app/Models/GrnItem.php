<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'grn_item_id',
        'item_id',
        'description',
        'weight',
        'unit_price',
        'discount_rate',
        'discount_amount',
        'total',
    ];

    public function grn()
    {
        return $this->belongsTo(Grn::class, 'grn_id', 'id');
    }
}
