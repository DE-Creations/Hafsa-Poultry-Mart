<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description',
        'price',
        'rate'
    ];

    public function supplierDiscounts()
    {
        return $this->hasMany(SupplierHasDiscount::class, 'discount_id', 'id');
    }
}
