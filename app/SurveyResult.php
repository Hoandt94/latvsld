<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyResult extends Model
{
    //
    protected $table = "survey_results";

    protected $fillable = [
        'company_id', 
        'set_question_id', 
        'question_id', 
        'user_id', 
        'assessment_id', 
        'answer', 
        'yes_note', 
        'yes_attachment', 
        'no_employee_id', 
        'no_finish_date', 
        'improve_note', 
        'improve_attachment', 
        'improve_employee_id', 
        'improve_finish_date'
    ];
}
