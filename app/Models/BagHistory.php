<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'bags_category_id',
        'date_time',
        'description',
        'qty',
    ];

    public function bagCategory(){
        return $this->belongsTo(BagsCategory::class, 'id', 'bags_category_id');
    }
    //our code

    // public function bagCategory()
    // {
    //     return $this->belongsTo(BagsCategory::class, 'bags_category_id', 'id');
    // }ai code


}
