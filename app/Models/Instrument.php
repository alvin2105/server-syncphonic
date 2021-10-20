<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $fillable = [
        'instrument_name',
        'intrument_brand',
        'intrument_count',
        'intrument_price',
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
