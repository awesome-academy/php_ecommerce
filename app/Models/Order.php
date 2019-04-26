<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'payment_id',
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
                    ->withPivot('quantity', 'price', 'discount')
                    ->withTimestamps();
    }

    public function getStatusAttribute()
    {
        if ($this->attributes['status'] == 0) {
            $arr = $this->returnStatusData('badge-info', trans('common.text.profile_page.status.pending'));

            return $arr;
        } elseif ($this->attributes['status'] == 1) {
            $arr = $this->returnStatusData('badge-success', trans('common.text.profile_page.status.accepted'));

            return $arr;
        } else {
            $arr = $this->returnStatusData('badge-danger', trans('common.text.profile_page.status.rejected'));

            return $arr;
        }
    }

    public function returnStatusData($class, $lang)
    {
        return [
            'class' => $class,
            'lang' => $lang,
        ];
    }
}
