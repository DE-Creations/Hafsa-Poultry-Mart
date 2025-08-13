<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_id',
        'output_item_id',
        'qty',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }

    public function outputItem()
    {
        return $this->belongsTo(OutputItem::class, 'output_item_id', 'id');
    }


}
