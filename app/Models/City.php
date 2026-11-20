<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'master_cities';

    protected $fillable = [
        'name',
        'state',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'city_id');
    }
}
