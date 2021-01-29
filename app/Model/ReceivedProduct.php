<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReceivedProduct extends Model
{
    protected $fillable = [
        'product_id', 'total_amount'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
