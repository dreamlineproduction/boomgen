<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userlist extends Model
{
    protected $table = 'userlist';
    protected $fillable = [
        'purchasedon', 'customerid', 'couponid'
    ];
}
