<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SetQuestion;
use App\Assessment;
use DB;
use Validator;
use Auth;
use App\User;
use Illuminate\Support\Str;

class AssessmentController extends Controller
{
    //
    public function index(){
        $setQuestions = SetQuestion::all();
        $assessments = Assessment::paginate(10);
        return view('main.assessment.index', ['set_questions' => $setQuestions, 'assessments' => $assessments]);
    }

    public function create(Request $request){
        try{
            if($request->isMethod('POST')){
                $rules = [
                    'name' => 'required',
                    'set_question' => 'required',
                ];
                $user = Auth::user();
                $messages = [
                    'name.required'  => 'Tên không được để trống.',
                    'set_question.required'  => 'Bộ câu hỏi không được để trống.',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
                }
                $result = Assessment::create([
                    'name' => $request->name,
                    'set_question_id' => (int)$request->set_question,
                    'company_id' => $user->company_id,
                ]);
                return response()->json(['status' => $result], 200);
            }
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function update($id, Request $request){
        try{
            $rules = [
                'name' => 'required',
                'set_question' => 'required',
            ];
            $user = Auth::user();
            $messages = [
                'name.required'  => 'Tên không được để trống.',
                'set_question.required'  => 'Bộ câu hỏi không được để trống.',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
            }
            $result = Assessment::where(['id' => $id])->update([
                'name' => $request->name,
                'set_question_id' => (int)$request->set_question,
            ]);
            return response()->json(['status' => $result], 200);
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function detail($id){
        $assessment = Assessment::find($id);
        return response()->json(['data' => $assessment], 200);
    }

    public function reload(Request $request){
        $result = Assessment::query();
        $assessments = $result->paginate(10);
        return view('main.assessment.list', ['assessments' => $assessments])->render();
    }

    public function run($slug){
        $arraySlug = explode('-', $slug);
        $id = $arraySlug[0];
        $assessment = Assessment::find($id);
        $user = Auth::user();
        if($user->company_id == $assessment->company_id)return view('main.assessment.detail', ['assessment' => $assessment]);
        else return redirect()->route('assessment');
    }

    public function runCategory($slugAssessment, $slugCategory){
        $slugAssessment = explode('-', $slug);
        $assessmentID = $arraySlug[0];
        $assessment = Assessment::find($assessmentID);

        $slugCategory = explode('-', $slugCategory);
        $categoryID = $arraySlug[0];
        $category = Assessment::find($categoryID);
        $user = Auth::user();

        return view('main.assessment.list_question', ['assessment' => $assessment, 'category' => $category]);
    }
}
