<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo('App\Admin', 'admin_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier', 'supplier_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment', 'payment_id', 'id');
    }

    public function purchaseItems()
    {
        return $this->hasMany('App\PurchaseItem');
    }
}
