<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecificProfession extends Model
{
    //
    protected $table = 'specific_professions';
    protected $fillable = [
        'name', 'code', 
    ];
}
