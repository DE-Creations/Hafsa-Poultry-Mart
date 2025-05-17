<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_id',
        'output_item_id',
        'selling_price',
        'available_qty',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id', 'stock_id');
    }
    //our code
    public function outputItem()
    {
        return $this->belongsTo(OutputItem::class, 'id', 'output_item_id');
    }
    //our code

    // public function stock()
    // {
    //     return $this->belongsTo(Stock::class, 'stock_id', 'id');
    // }
    //AI code
    // public function outputItem()
    // {
    //     return $this->belongsTo(OutputItem::class, 'output_item_id', 'id');
    // }
    //AI code

    public function invoiceItem()
    {
        return $this->hasMany(InvoiceItem::class, 'stock_item_id', 'id');
    }
}
