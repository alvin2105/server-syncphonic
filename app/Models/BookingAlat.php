<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BookingAlat extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [

        'instrument_id',
        'user_id',
        'name',
        'email',
        'instrument_name',
        'instrument_price',
        'date'.
        'duration',
        'total',
        'status_booking',
    ];
  
}

