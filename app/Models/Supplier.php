<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'nic',
        'description',
        'bank_account_id',
    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'bank_account_id', 'id');
    }
}
