<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    protected $table = 'payment_historys'; // explicitly set if not Laravel's default plural

    protected $fillable = [
        'student_id',
        'paid_amount',
    ];

    /**
     * Relationship: A payment belongs to a student.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
