<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    //
    protected $table = 'company_infos';
    protected $fillable = [
        'id', 
        'company_id', 
        'user_id', 
        'assessment_id', 
        'total_employee', 
        'total_female_employee', 
        'total_type_1', 
        'total_type_2', 
        'total_type_3', 
        'total_type_4', 
        'total_type_5'
    ];
    
}
