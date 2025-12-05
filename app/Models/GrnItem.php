<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'grn_id',
        'item_name',
        'weight',
        'unit_price',
        'amount',
    ];

    public function grn()
    {
        return $this->belongsTo(Grn::class, 'grn_id', 'id');
    }

    public function inputItem()
    {
        return $this->belongsTo(InputItem::class, 'item_name', 'id');
    }
}
