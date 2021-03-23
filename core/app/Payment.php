<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $guarded = [];

    const METHOD_CASH = 1;
    const METHOD_CHECK = 2;
    const METHOD_DEPOSIT = 3;

    const STATUS_DUE = 1;
    const STATUS_PAID = 2; 
    const STATUS_PENDING = 3;
    const STATUS_PARTIAL = 4;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier', 'user_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin', 'admin_id', 'id');
    }
}
