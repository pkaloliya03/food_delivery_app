<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'order_no',
        'customer_id',
        'username',
        'customer_name',
        'mobile',
        'restaurant_id',
        'address',
        'city',
        'pincode',
        'instructions',
        'subtotal',
        'delivery_charge',
        'total_amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'delivery_charge' => 'decimal:2',
            'total_amount' => 'decimal:2',
        ];
    }

    // Order belongs to a customer.
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'customer_id');
    }

    // Order belongs to a restaurant.
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    // Order contains multiple items.
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
