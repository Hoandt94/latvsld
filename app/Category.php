<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 
        // 'code', 
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
}
