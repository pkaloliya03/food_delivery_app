<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'master_restaurants';

    protected $fillable = [
        'owner_id',
        'name',
        'logo',
        'cover_image',
        'description',
        'mobile',
        'city_id',
        'address',
        'opening_time',
        'closing_time',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function owner()
    {
        return $this->belongsTo(Users::class, 'owner_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'restaurant_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'restaurant_id');
    }
}
