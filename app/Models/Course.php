<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'course_desc',
        'course_capacity',
        'course_mentor',
        'course_status',
        'course_price',
        'course_status',
      
       
    ];

    public function user() //N to N
    {
         return $this->belongsToMany(User::class);
    }
}
