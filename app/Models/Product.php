<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'stock_quantity',
        'image',
        'price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeName($query, $slug)
    {
        if (!is_null($slug)) {
            return $query->where('slug', 'like', '%'.$slug.'%');
        }

        return $query;
    }

    public function scopePrice($query, $priceFrom, $priceTo)
    {
        return $query->whereBetween('price', [$priceFrom, $priceTo]);
    }

    public function getQtyAttribute()
    {
        if ($this->attributes['stock_quantity'] > config('setting.number_unavailable_limit')) {
            return true;
        }

        return false;
    }
}
