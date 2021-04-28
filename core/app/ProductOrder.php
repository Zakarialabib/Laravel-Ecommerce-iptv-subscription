<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $guarded = [];

    const PENDING_STATUS = 'pending';
    const PROCESSING_STATUS = 'processing';
    const COMPLETED_STATUS = 'completed';
    const REJECTED_STATUS = 'rejected';
    
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
