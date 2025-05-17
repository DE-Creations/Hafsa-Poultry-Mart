<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nick_name',
        'mobile',
        'address',
        'note',
        'date_registered',
    ];

    public function grn()
    {
        return $this->hasMany(GRN::class, 'supplier_id', 'id');
    }
}
