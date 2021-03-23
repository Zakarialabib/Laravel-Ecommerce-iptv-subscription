<?php

namespace App;

use App\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password','role_id', 'name', 'username', 'image', 'status'

    ];
    
    public function role() : BelongsTo
    {
      return $this->belongsTo(Role::class, 'role_id');
    }


    public function sales()
    {
        return $this->hasMany('App\Sale');
    }

    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

}
