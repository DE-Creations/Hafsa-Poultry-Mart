<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'item_name',
        'description',
        'weight',
        'unit_price',
        'amount',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'id', 'invoice_id');
    }
    //our code

    public function stockItem()
    {
        return $this->belongsTo(StockItem::class, 'id', 'stock_item_id');
    }
    //our code

    // public function invoice()
    // {
    //     return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    // }
    //AI code

    // public function stockItem()
    // {
    //     return $this->belongsTo(StockItem::class, 'stock_item_id', 'id');
    // }
    //AI code
}
