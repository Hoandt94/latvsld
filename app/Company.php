<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = "companies";

    protected $fillable = [
        'name', 
        'code', 
        'status',
    ];

    public function getSetQuestion(){
        return $this->hasMany('App\CompanySetQuestion', 'company_id', 'id');
    }
}
