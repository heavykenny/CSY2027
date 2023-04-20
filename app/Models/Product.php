<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'vendor_id',
        'sizes',
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getAvgRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    //accessor for the sizes attribute:
    public function getSizesAttribute($value)
    {
        return $value ? json_decode($value) : [];
    }

    //mutator for the sizes attribute:
    public function setSizesAttribute($value)
    {
        $this->attributes['sizes'] = $value ? json_encode($value) : null;
    }

}
