<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grn extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'grn_number',
        'supplier_id',
        'date',
        'sub_total',
        'total',
    ];

    public static function generateGrnNumber()
    {
        $lastGrn = Grn::orderBy('id', 'desc')->withTrashed()->first();
        if ($lastGrn) {
            $lastGrnNumber = $lastGrn->grn_number;
            $newGrnNumber = (int)str_replace('GRN', '', $lastGrnNumber) + 1;
            return 'GRN' . str_pad($newGrnNumber, 5, '0', STR_PAD_LEFT);
        }
        return 'GRN00001';
    }

    public function grnPay()
    {
        return $this->hasOne(GrnPay::class, 'grn_id', 'id');
    }

    public function grnItem()
    {
        return $this->hasMany(GrnItem::class, 'id', 'grn_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
