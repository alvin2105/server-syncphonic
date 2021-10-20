<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = [
        'studio_name',
        'studio_desc',
        'studio_capacity',
        'studio_price',
        'studio_available_day',
        'studio_img',
        'studio_status',
        'studio_package_name',
        'studio_package_desc',
        'studio_package_price',
       
    ];

    public function user() // N to 1
    {
        return $this->hasMany(User::class);
    }
}
