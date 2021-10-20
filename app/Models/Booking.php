<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_category',
        'booking_name',
        'booking_start',
        'booking_end',
        'booking_date',
        'booking_check',
        'booking_status',
       
    ];
}
