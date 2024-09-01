<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'code'
    ];

    public function accounts()
    {
        return $this->hasMany(BankAccount::class, 'bank_id', 'id');
    }

    public function branches()
    {
        return $this->hasMany(BankBranch::class, 'bank_id', 'id');
    }
}
