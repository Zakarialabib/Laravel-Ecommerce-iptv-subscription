<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];
    
    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function sale()
    {
        return $this->belongsTo('App\Sale', 'sale_id', 'id');
    }
}
