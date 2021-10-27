<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;

class Instrument extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'instrument_name',
        'instrument_brand',
        'instrument_desc',
        'instrument_count',
        'instrument_price',
        'instrument_img',
        'intrument_bundling_name',
        'intrument_bundling_desc',
        'intrument_bundling_price',
        'instrument_status',
       
    ];

    public function user() //N to 1
    {
         return $this->belongsTo(User::class);
    }
}
