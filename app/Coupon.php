<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'logo', 'title', 'couponcode', 'description', 'percentage', 'fixed', 'amount', 'expirydate', 'status', 'selecteduser'
    ];

    protected $casts = [
        'selecteduser' => 'array'
    ];
}

