<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceGrnCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_total',
        'grn_total',
    ];

    public function getById($id)
    {
        return $this->where('id', $id)->first();
    }
}
