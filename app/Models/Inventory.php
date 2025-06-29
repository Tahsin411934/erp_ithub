<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'inventory';

    protected $fillable = [
        'item_id',
        'quantity',
        'price',
        'location',
        'expiry_date',
        'supplier'
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }
}