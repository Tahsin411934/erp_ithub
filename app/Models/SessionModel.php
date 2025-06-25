<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionModel extends Model
{
    protected $table = 'session'; // table name

    protected $fillable = [
        'session',
        'batch',
    ];

    public $timestamps = true; // enable created_at and updated_at
}
