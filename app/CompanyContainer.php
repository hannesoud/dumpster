<?php

namespace App;
use App\Container;

use Illuminate\Database\Eloquent\Model;

class CompanyContainer extends Model
{
    //
    protected $table = "company_containers";

    protected $fillable=[
        'company_id',
        'container_id',
        'price',
        'quantity'
    ];

    public $timestamps=false;

    public function getImageAttribute()
    {
        $container_id = $this->container_id;
        $container = Container::find($container_id);
        if($container)
        {
            return $container->image;
        }
    }

    public function getNameAttribute()
    {
        $container_id = $this->container_id;
        $container = Container::find($container_id);
        if($container)
        {
            return $container->name;
        }
    }

    public function getCapacityAttribute()
    {
        $container_id = $this->container_id;
        $container = Container::find($container_id);
        if($container)
        {
            return $container->capacity;
        }
    }


    public function getWeightAttribute()
    {
        $container_id = $this->container_id;
        $container = Container::find($container_id);
        if($container)
        {
            return $container->weight;
        }
    }

}
