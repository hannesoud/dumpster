<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyImage extends Model
{
    //
    protected $table="images";

    protected $fillable=['filename', 'user_id'];

    public $timestamps = false;
}
