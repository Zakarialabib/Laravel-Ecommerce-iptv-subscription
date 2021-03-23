<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $guarded = [];
    
    public function orderitems() {
        return $this->hasMany('App\OrderItem');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function sale()
    {
        return $this->belongsTo('App\Sale', 'sale_id', 'id');
    }
}
