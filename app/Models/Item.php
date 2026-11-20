<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'master_items';

    protected $fillable = [
        'restaurant_id',
        'category_id',
        'name',
        'image',
        'description',
        'price',
        'is_veg',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_veg' => 'boolean',
            'status' => 'boolean',
        ];
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
