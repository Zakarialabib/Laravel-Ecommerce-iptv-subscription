<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $guarded = [];

    const MONTHLY_PLAN = 1; 
    const QUARTER_PLAN = 2; 
    const SEMIANNUAL_PLAN = 3; 
    const ANNUAL_PLAN = 4; 

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
