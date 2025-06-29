<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';
    protected $fillable = [
        'name',
        'image',
        'category_id',
        'uom'
    ];

    public function category()
    {
        return $this->belongsTo(StationaryCategory::class, 'category_id', 'category_id');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/'.$this->image) : asset('images/default-item.png');
    }
    public function items()
{
    return $this->hasMany(SaleItem::class);
}
}