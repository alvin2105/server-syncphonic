<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BookingStudio extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [

    'studio_id',
    'user_id',
    'name',
    'email',
    'studio_name',
    'studio_price',
    'date'.
    'duration',
    'total',
    'status_booking',
    


 
    ];
}
