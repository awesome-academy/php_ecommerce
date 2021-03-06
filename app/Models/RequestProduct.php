<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Statusable;

class RequestProduct extends Model
{
    use Statusable;

    protected $fillable = [
        'user_id',
        'product_name',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
