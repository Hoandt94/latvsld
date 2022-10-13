<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Assessment extends Model
{
    //
    protected $table = 'assessments';

    protected $fillable = [
        'name', 
        'set_question_id',
        'company_id'
    ];

    public function company(){
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }

    public function setQuestion(){
        return $this->belongsTo('App\SetQuestion', 'set_question_id', 'id');
    }

    public function slug(){
        return $this->id . '-' . Str::slug($this->name);
    }

    public function getQuestionAnswered($categoryID){
        $category = Category::find($categoryID);
        $listQuestionID = $category->getQuestion->modelKeys();

        $answers = SurveyResult::where(['assessment_id' => $this->id])->whereIn('question_id', $listQuestionID)->get();
        return $answers;
    }
}
