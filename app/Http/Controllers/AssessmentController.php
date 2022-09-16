<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    //
    public function index(){
        return view('main.assessment.index');
    }

    public function run(){
        return view('main.assessment.detail');
    }
}
