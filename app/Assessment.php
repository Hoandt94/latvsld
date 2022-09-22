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
        return Str::slug($this->name);
    }
}
