<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grn extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'grn_no',
        'supplier_id',
        'date',
        'delivary_address',
        'sub_total',
        'discount',
        'total',
        'is_paid',
    ];

    public static function generateGrnNumber()
    {
        $lastGrn = Grn::orderBy('id', 'desc')->withTrashed()->first();
        if ($lastGrn) {
            $lastGrnNumber = $lastGrn->grn_no;
            $newGrnNumber = (int)str_replace('GRN', '', $lastGrnNumber) + 1;
            return 'GRN' . str_pad($newGrnNumber, 5, '0', STR_PAD_LEFT);
        }
        return 'GRN00001';
    }

    public function grnpay()
    {
        return $this->hasMany(GrnPay::class, 'id', 'grn_id');
    }

    public function grnitem()
    {
        return $this->hasMany(GrnItem::class, 'id', 'grn_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
