<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nic',
        'mobile',
        'city',
    ];

    public function grn()
    {
        return $this->hasMany(GRN::class, 'supplier_id', 'id');
    }
}
