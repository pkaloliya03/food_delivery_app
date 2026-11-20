<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'master_categories';

    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'sort_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
