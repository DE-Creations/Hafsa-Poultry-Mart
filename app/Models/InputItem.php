<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function grnItem()
    {
        return $this->hasMany(GRNItem::class, 'input_item_id', 'id');
    }

    public function stockvalidation()
    {
        return $this->hasMany(StockValidation::class, 'input_item_id', 'id');
    }

    public function outputItem()
    {
        return $this->hasMany(OutputItem::class, 'input_item_id', 'id');
    }
}
