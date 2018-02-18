<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'w_companies';

    protected $fillable = [
        'name', 'email', 'license', 'details', 'address', 'phone', 'password',
    ];

    protected $hidden = [
        'password',
    ];

}
