<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    //
    protected $table = 'containers';

    protected $fillable = [
        'name',  'image_id',  'price', 'capacity', 'details', 'status', 'company_id', 'weight',
    ];

    const CREATED_AT = 'added';

    const CONTAINER_STATUS_ACTIVE = 0;
    const CONTAINER_STATUS_HIDDEN = 1;

    public function getImageAttribute()
    {
        $image = CompanyImage::find($this->image_id);
        if($image)
        {
            return $image->filename;
        }
    }

    public function getStatusStrAttribute()
    {
        if($this->status == 0)
        {
            return "ACTIVE";
        } else {
            return "HIDDEN";
        }
    }
}
