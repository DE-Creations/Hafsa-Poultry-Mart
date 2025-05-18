<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutputItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'input_item_id',
        'name',
        'description',
        'avg_presentage',
    ];

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

    public function stockItem()
    {
        return $this->hasMany(StockItem::class, 'output_item_id', 'id');
    }
    public function stockValidation()
    {
        return $this->hasMany(StockValidation::class, 'output_item_id', 'id');
    }
    public function stockdetails()
    {
        return $this->hasMany(StockDetails::class, 'output_item_id', 'id');
    }
}
