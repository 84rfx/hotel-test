<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    protected $fillable = [
        'reservation_id',
        'file_path',
        'file_type',
        'original_name',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
