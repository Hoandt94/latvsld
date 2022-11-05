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

        $answers = SurveyResult::where(['assessment_id' => $this->id])->whereIn('question_id', $listQuestionID)->whereNull('history')->get();
        return $answers;
    }

    public function countQuestionAnswered($categoryID){
        $category = Category::find($categoryID);
        $subCategories = $category->getSubCategory;
        $count = 0;
        if(count($subCategories)){
            foreach($subCategories as $subCategory){
                $count+= $this->countQuestionAnswered($subCategory->id);
            }
            return $count;
        }
        else{
            $listQuestionID = $category->getQuestion->modelKeys();
            $answers = SurveyResult::where(['assessment_id' => $this->id])->whereIn('question_id', $listQuestionID)->whereNull('history')->get();
            return count($answers);
        }
    }

    public function countAnswerImprove($categoryID){
        $category = Category::find($categoryID);
        $subCategories = $category->getSubCategory;
        $count = 0;
        if(count($subCategories)){
            foreach($subCategories as $subCategory){
                $count+= $this->countAnswerImprove($subCategory->id);
            }
            return $count;
        }
        else{
            $listQuestionID = $category->getQuestion->modelKeys();
            $answers = SurveyResult::where(['assessment_id' => $this->id, 'answer' => 'improve'])->whereNull('history')->whereIn('question_id', $listQuestionID)->get();
            return count($answers);
        }
    }

    public function countAnswerYes($categoryID){
        $category = Category::find($categoryID);
        $subCategories = $category->getSubCategory;
        $count = 0;
        if(count($subCategories)){
            foreach($subCategories as $subCategory){
                $count+= $this->countAnswerYes($subCategory->id);
            }
            return $count;
        }
        else{
            $listQuestionID = $category->getQuestion->modelKeys();
            $answers = SurveyResult::where(['assessment_id' => $this->id, 'answer' => 'yes'])->whereNull('history')->whereIn('question_id', $listQuestionID)->get();
            return count($answers);
        }
    }

    public function countAnswerNo($categoryID){
        $category = Category::find($categoryID);
        $subCategories = $category->getSubCategory;
        $count = 0;
        if(count($subCategories)){
            foreach($subCategories as $subCategory){
                $count+= $this->countAnswerNo($subCategory->id);
            }
            return $count;
        }
        else{
            $listQuestionID = $category->getQuestion->modelKeys();
            $answers = SurveyResult::where(['assessment_id' => $this->id, 'answer' => 'no'])->whereNull('history')->whereIn('question_id', $listQuestionID)->get();
            return count($answers);
        }
    }

    public function countAllAnswered(){
        $categories = $this->setQuestion->getAllCategories();
        $result = [];
        foreach($categories as $category){
            $answersYes = $this->countAnswerYes($category->id);
            $answersNo = $this->countAnswerNo($category->id);
            $answersImprove = $this->countAnswerImprove($category->id);
            $answers = $this->countQuestionAnswered($category->id);
            $result[] = [
                'name' => $category->name,
                'yes' => $answersYes,
                'no' => $answersNo,
                'improve' => $answersImprove,
                'total' => $answers,
                'id' => $category->id,
                'parent_id' => $category->parent_id
            ];
        }
        return $this->parent_sort($result);
    }

    function getAllAnswerImprove(){
        $answers = SurveyResult::where(['assessment_id' => $this->id, 'answer' => 'improve'])->whereNull('history')->get();
        return $answers;
    }

    public function parent_sort(array $objects, array &$result=array(), $parent=0, $depth=0) {
        foreach ($objects as $key => $object) {
            if ($object['parent_id'] == $parent) {
                $object['depth'] = $depth;
                array_push($result, $object);
                unset($objects[$key]);
                $this->parent_sort($objects, $result, $object['id'], $depth + 1);
            }
        }
        return $result;
    }
}
