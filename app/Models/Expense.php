<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'expense_category_id',
        'date',
        'description',
        'note',
        'amount',
        'image_id',
    ];

    protected $appends = [
        'image_url',
        // 'category_name',
        'formatted_amount'
    ];

    public function getImageUrlAttribute()
    {
        return $this->image->name ?? null;
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    // public function getCategoryNameAttribute()
    // {
    //     return $this->expenseCategory ? $this->expenseCategory->name : 'N/A';
    // }

    // public function ExpenseCategory()
    // {
    //     return $this->hasOne(ExpenseCategory::class, 'id', 'expense_category_id');
    // }

    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2);
    }
}
