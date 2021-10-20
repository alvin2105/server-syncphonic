<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingStudio extends Model
{
    use HasFactory;

    protected $fillable = [

    'studio_id',
    'user_id',
    'name',
    'studio_name',
    'studio_price',
    'date'.
    'duration',
    'total',
    'status_booking',
    


 
    ];
}
