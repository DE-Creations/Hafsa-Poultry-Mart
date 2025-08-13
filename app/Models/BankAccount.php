<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bank_id',
        'branch_id',
        'is_active',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(BankBranch::class, 'branch_id', 'id');
    }
    
    public function invoicePayement(){
        return $this->hasMany(InvoicePayment::class, 'bank_acc_id', 'id');
    }

    public function grnPayement(){
        return $this->hasMany(GrnPay::class, 'bank_acc_id', 'id');
    }

    // public function bank()
    // {
    //     return $this->belongsTo(Bank::class, 'bank_id', 'id');
    // }

    // public function branch()
    // {
    //     return $this->belongsTo(BankBranch::class, 'branch_id', 'id');
    // }

    // public function supplier()
    // {
    //     return $this->hasOne(Supplier::class, 'bank_account_id', 'id');
    // }
}
