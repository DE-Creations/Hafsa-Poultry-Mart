<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagsCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'qty',
    ];

    public function bagHistory()
    {
        return $this->hasMany(BagHistory::class, 'bags_category_id', 'id');
    }
    
}
