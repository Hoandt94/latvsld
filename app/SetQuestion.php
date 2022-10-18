<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SetQuestion extends Model
{
    protected $table = 'set_questions';
    protected $fillable = [
        'name', 'code', 'questions', 'categories', 'status'
    ];

    public function getCategories(){
        if(!empty($this->categories)){
            $category_ids = json_decode($this->categories, true);
            $categories = Category::whereNull('parent_id')->whereIn('id', $category_ids)->orderBy('order', 'ASC')->get();
            return $categories;
        }
        return [];
    }

    public function getQuestions(){
        $questions_ids = json_decode($this->questions);
        $questions = Question::whereIn('id', $category_ids)->orderBy('order', 'ASC')->get();
        return $questions;
    }
    
    public function slug(){
        return Str::slug($this->name);
    }
}
