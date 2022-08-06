<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'code', 'parent_id', 'order'
    ];

    public function getSubCategory(){
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }
}
