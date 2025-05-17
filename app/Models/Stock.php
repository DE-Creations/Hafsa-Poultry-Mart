<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_name',
        'grn_item_id',
        'input_qty',
        'output_qty',
        'wastage_qty',
        'update_time',
        'is_stock_closed',
    ];

    public function grnItem()
    {
        return $this->belongsTo(GRNItem::class, 'id', 'grn_item_id');
    }
    //our code

    // public function grnItem()
    // {
    //     return $this->belongsTo(GRNItem::class, 'grn_item_id', 'id');
    // }
    //AI code
    
    public function stockItem()
    {
        return $this->hasMany(StockItem::class, 'stock_id', 'id');
    }

    public function stockdetails()
    {
        return $this->hasMany(StockDetails::class, 'stock_id', 'id');
    }
}
