<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    const PUBLISHED_STATUS = 1;
    const UNPUBLISHED_STATUS = 0;

    protected $casts = [
        'status' => 'integer',
    ];
}
