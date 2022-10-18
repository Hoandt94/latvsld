<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySetQuestion extends Model
{
    //
    protected $table = "company_set_questions";
    protected $fillable = [
        'company_id', 'set_question_id'
    ];
}
