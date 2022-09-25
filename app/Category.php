<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 
        'code', 
        'parent_id', 
        'order', 
        'status',
    ];

    public function getSubCategory(){
        return $this->hasMany('App\Category', 'parent_id', 'id')->orderBy('order', 'ASC');
    }

    public function getQuestion(){
        return $this->hasMany('App\Question', 'category_id', 'id');
    }

    public function parentCategory(){
        return $this->belongsTo('App\Category', 'parent_id', 'id');
    }

    public function getCode(){
        if(empty($this->parent_id)) return $this->order;
        else{
            $parent = $this->parentCategory;
            return $parent->getCode() . '.' . $this->order;
        }
    }

    public function getQuestionInSet($listQuestion){
        $questions = Question::whereIn('id', $listQuestion)->where('category_id', $this->id)->get();
        return $questions;
    }

    public function getCategoryInSet($listCategory){
        $questions = Category::whereIn('id', $listCategory)->where('parent_id', $this->id)->get();
        return $questions;
    }

    public function slug(){
        return Str::slug($this->name);
    }
}
