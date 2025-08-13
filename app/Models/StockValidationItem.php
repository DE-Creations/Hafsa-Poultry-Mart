<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockValidationItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_validation_id',
        'output_item_id',
        'qty',
    ];

    public function stockValidation()
    {
        return $this->belongsTo(StockValidation::class, 'stock_validation_id', 'id');
    }

    public function outputItem()
    {
        return $this->belongsTo(OutputItem::class, 'output_item_id', 'id');
    }
}
