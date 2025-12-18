<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Ditambahkan
use App\Models\PersonalData; // Ditambahkan
use App\Models\User; // Ditambahkan
use App\Models\Room; // Ditambahkan

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'guests',
        'total_amount',
        'status',
        'special_requests',
        'additional_services'
    ];

    protected $casts = [
        // Menggunakan 'datetime' untuk representasi tanggal dan waktu yang fleksibel
        'check_in' => 'datetime',
        'check_out' => 'datetime',

        // Memastikan kolom array tersimpan sebagai JSON
        'special_requests' => 'array',
        'additional_services' => 'array',
        'total_amount' => 'decimal:2',
        'status' => 'string'
    ];

    /**
     * Get the user that owns the Reservation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the room that the Reservation belongs to.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the personal data records associated with the Reservation.
     */
    public function personalData(): HasMany // Tipe return ditambahkan
    {
        return $this->hasMany(PersonalData::class, 'reservation_id'); // Eksplisitkan foreign key jika perlu
    }

    /**
     * Boot the model and add global scope for auto-checkout
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-checkout expired reservations when accessed
        // Temporarily disabled due to CHECK constraint issues
        // static::retrieved(function ($reservation) {
        //     if (in_array($reservation->status, ['confirmed', 'checked_in']) &&
        //         $reservation->check_out < now()->toDateString()) {
        //         $reservation->update(['status' => 'checked_out']);
        //     }
        // });
    }
}
