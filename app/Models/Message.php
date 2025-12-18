<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'department',
        'subject',
        'message',
        'read',
        'read_at',
    ];
}
