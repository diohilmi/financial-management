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
    //
}
