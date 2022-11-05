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
        'no_attachment', 
        'no_note', 
        'improve_note', 
        'improve_attachment', 
        'improve_employee_id', 
        'improve_finish_date'
    ];

    public function getQuestion(){
        return $this->belongsTo('App\Question', 'question_id', 'id');
    }

    public function getImproveEmployee(){
        return $this->belongsTo('App\User', 'improve_employee_id', 'id');
    }

    public function getNoEmployee(){
        return $this->belongsTo('App\User', 'no_employee_id', 'id');
    }
}
