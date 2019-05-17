<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeName($query, $slug)
    {
        if (!is_null($slug)) {
            return $query->where('slug', 'like', '%'.$slug.'%');
        }

        return $query;
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
