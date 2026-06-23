<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'description',
        'image',
        'battery_range',
        'top_speed',
        'stock',
        'featured',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}