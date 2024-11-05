<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'date',
        'amount',
        'note',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeExpenses($query)
    {
        return $query->whereHas('category', function ($query) {
            $query->where("is_expense", 1);
        });
    }

    public function scopeIncome($query)
    {
        return $query->whereHas('category', function ($query) {
            $query->where("is_expense", 0);
        });
    }
    
    //
}
