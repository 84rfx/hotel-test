<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodOrder extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'room_number',
        'items',
        'total_amount',
        'status',
        'special_instructions',
        'delivery_time',
    ];

    protected $casts = [
        'items' => 'array',
        'total_amount' => 'decimal:2',
        'delivery_time' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
