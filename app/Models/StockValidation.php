<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockValidation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'date_added',
        'input_item_id',
        'qty',
    ];

    public function inputItem()
    {
        return $this->belongsTo(InputItem::class, 'input_item_id', 'id');
    }

    public function stockvalidationitem()
    {
        return $this->hasMany(StockValidationItem::class, 'stock_validation_id', 'id');
    }
}
