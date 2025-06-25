<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'grn_id',
        'weight',
        'unit_price',
        'amount',
    ];

    public function grn()
    {
        return $this->belongsTo(Grn::class, 'id', 'grn_id');
    }
    //our code

    // public function grn()
    // {
    //     return $this->belongsTo(Grn::class, 'grn_id', 'id');
    // }
    //AI code

    public function inputItem()
    {
        return $this->belongsTo(InputItem::class, 'id', 'input_item_id');
    }
    //our code

    // public function inputItem()
    // {
    //     return $this->belongsTo(InputItem::class, 'input_item_id', 'id');
    // }
    //AI code

}
