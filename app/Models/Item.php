<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'item_category_id',
        'price',
    ];

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id', 'id');
    }
    //look and delete
}
