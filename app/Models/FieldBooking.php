<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'field_type', 'field_name', 'booking_time', 'status'
    ];
}
