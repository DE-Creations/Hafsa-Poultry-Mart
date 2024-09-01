<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'account_no',
        'bank_id',
        'branch_id',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(BankBranch::class, 'branch_id', 'id');
    }
}
