<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicePack extends Model
{
    //
    protected $table = "service_packs";

    protected $fillable = [
        'name', 
        'description',
        'price',
        'status',
    ];
}
