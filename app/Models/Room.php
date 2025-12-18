<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'capacity',
        'price_per_night',
        'available',
        'amenities',
        'image',
    ];

    protected $casts = [
        'amenities' => 'array',
        'available' => 'boolean',
        'price_per_night' => 'decimal:2',
    ];
}
