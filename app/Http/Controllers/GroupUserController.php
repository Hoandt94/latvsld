<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupUserController extends Controller
{
    //
    public function index(){
        return view('admin.group_user.index');
    }

    public function create(){
        return view('admin.group_user.create');
    }

    public function detail(){

    }
}
