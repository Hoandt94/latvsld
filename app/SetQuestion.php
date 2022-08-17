<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetQuestion extends Model
{
    protected $table = 'set_questions';
    protected $fillable = [
        'name', 'code', 'questions', 'categories', 'status'
    ];
}
