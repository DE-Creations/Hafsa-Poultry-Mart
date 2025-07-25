<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'output_item_id',
        'unit_price',
        'balance',
    ];

    public function outputItem()
    {
        return $this->belongsTo(OutputItem::class, 'output_item_id', 'id');
    }
}
