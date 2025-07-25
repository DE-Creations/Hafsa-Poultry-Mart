<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutputItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function getById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'output_item_id', 'id');
    }
}
