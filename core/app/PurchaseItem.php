<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $guarded = [];

    public function purchase()
    {
        return $this->belongsTo('App\Purchase', 'purchase_id', 'id');
    }
}
