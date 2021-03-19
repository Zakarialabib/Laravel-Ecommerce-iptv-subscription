<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable =[

        "name", "company_name", "tax_number",
        "email", "phone_number", "address", "city", "is_active"
    ];

}
