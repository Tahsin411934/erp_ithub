<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'father_name',
        'mother_name',
        'phone_number',
        'district',
        'tana',
        'vill',
        'course_id',
        'fee',
        'address',
        'session',
        'image',
        'year',
        'signature',
        'status',
        'branc_code',
        'date_of_birth',
        'batch',
    ];
}
