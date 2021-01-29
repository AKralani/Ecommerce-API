<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'client_id', 'product_id', 'total_amount'
    ];

    public function client() {
        return $this->belongsTo('App\Model\Client');
    }
    public function products() {
        return $this->hasMany('App\Model\SoldProduct');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }

    //test
    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
