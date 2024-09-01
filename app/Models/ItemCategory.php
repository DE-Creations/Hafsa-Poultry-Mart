<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'item_category_id', 'id');
    }
}
