<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankBranch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class, 'branch_id', 'id');
    }

    // public function accounts()
    // {
    //     return $this->hasMany(BankAccount::class, 'branch_id', 'id');
    // }

    // public function bank()
    // {
    //     return $this->belongsTo(Bank::class, 'bank_id', 'id');
    // }
}
