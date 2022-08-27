<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManufacturingField extends Model
{
    //
    protected $table = 'manufacturing_fields';
    protected $fillable = [
        'name', 'code', 'status'
    ];
}
