<?php

namespace App;

use App\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    public function admins() : HasMany
    {
        return $this->hasMany(Admin::class);
    }
}