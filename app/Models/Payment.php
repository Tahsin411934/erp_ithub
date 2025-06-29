<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'total_payable',
        'total_due',
        'total_paid',
    ];

   

  public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}