<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $table = 'questions';

    protected $fillable = [
        'code',
        'category_id',
        'guide_attachment',
        'sample_attachment',
        'content',
        'approve_help',
        'term',
        'penalty_min',
        'penalty_max',
        'guide',
        'required',
        'answer_expression',
        'tags',
        'order',
        'status',
    ];

    public function getCategory(){
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function getPenalty(){
        $min = 0;
        $max = 0;
        if(!empty($this->penalty_min)){
            foreach(json_decode($this->penalty_min, true) as $penalty){
                $min+=$penalty;
            }
        }
        if(!empty($this->penalty_max)){
            foreach(json_decode($this->penalty_max, true) as $penalty){
                $max+=$penalty;
            }
        }
        return ['min' => $min, 'max' => $max];
    }
}
