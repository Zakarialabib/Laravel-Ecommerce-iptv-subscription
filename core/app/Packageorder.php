<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Packageorder extends Model
{
    protected $guarded = [];
    protected $casts = [
        'package_status' => 'integer',
    ];

    const INACTIVE = 1; 
    const NEAR_END = 2;
    const ACTIVE = 3; 

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
    public function sale()
    {
        return $this->belongsTo('App\Sale', 'sale_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
