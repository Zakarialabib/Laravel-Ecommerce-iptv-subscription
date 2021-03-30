<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    protected $guarded = [];

    const PUBLISHED_STATUS = 1;
    const UNPUBLISHED_STATUS = 0;

    protected $casts = [
        'status' => 'integer',
    ];

    public function packageorders(): HasMany
    {
        return $this->hasMany(Packageorder::class, 'package_id');
    }
    
    public function billpaids(): HasMany
    {
        return $this->hasMany(Billpaid::class, 'package_id');
    }

    public function plans()
    {
        return $this->hasMany(Plan::class, 'package_id');
    }

}
