<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_product' => 'boolean',
    ];

    public function scopeProducts($query)
    {
        return $query->where('is_product', 1);
    }

    public function scopePackages($query)
    {
        return $query->where('is_product', 0);
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin', 'admin_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment', 'payment_id', 'id');
    }

    public function orderitems()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function order()
    {
        return $this->hasOne('App\ProductOrder');
    }
}
