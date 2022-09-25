<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\SetQuestion;
use App\Category;
use App\Question;

class SetQuestionController extends Controller
{
    //
    public function index(){
        $setQuestions = SetQuestion::paginate(10);
        return view('admin.set_question.index', ['setQuestions' => $setQuestions]);
    }

    public function create(Request $request){
        try{
            if($request->isMethod('POST')){
                $rules = [
                    'name' => 'required',
                    'code' => 'required|unique:set_questions',
                ];
                $messages = [
                    'required'  => ':attribute không được để trống.',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
                }
                $result = SetQuestion::create([
                    'name' => $request->name,
                    'code' => $request->code,
                    'status' => isset($request->status) ? 1 : 0
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
            if($request->isMethod('POST')){
                $rules = [
                    'name' => 'required',
                    'code' => 'required',
                ];
                $messages = [
                    'required'  => ':attribute không được để trống.',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
                }
                $result = SetQuestion::where(['id' => $id])->update([
                    'name' => $request->name,
                    'code' => $request->code,
                    'status' => isset($request->status) ? 1 : 0
                ]);
                return response()->json(['status' => $result], 200);
            }
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function detail($id){
        $category = SetQuestion::find($id);
        return response()->json(['data' => $category], 200);
    }

    public function delete($id){
        $category = SetQuestion::find($id);
        $subs = $category->getSubCategory;
        $questions = $category->getQuestion;
        if($subs->isEmpty() && $questions->isEmpty()) {
            $result = $category->delete();
            return response()->json(['status' => $result], 200);
        }
        else return response()->json(['status' => 0, 'msg' => "Không thể xóa. Danh mục có câu hỏi hoặc danh mục con."], 200);
    }

    public function reload(){
        $setQuestions = SetQuestion::paginate(10);
        return view('admin.set_question.list', ['setQuestions' => $setQuestions])->render();
    }

    public function config($id, Request $request){
        if($request->isMethod('GET')){
            $categories = Category::whereNull('parent_id')->get();
            $setQuestion = SetQuestion::find($id);
            $allQuestion = Question::all();
            $allCategory = Category::all();
            return view('admin.set_question.config', ['categories' => $categories, 'setQuestion' => $setQuestion, 'allQuestion' => $allQuestion, 'allCategory' => $allCategory]);
        }
        else{
            try{
                $categories = !empty($request->categories) ? $request->categories : [];
                $categories = array_map(function($o){return (int)$o;}, $categories);
                $questions = !empty($request->questions) ? $request->questions : [];
                $questions = array_map(function($o){return (int)$o;}, $questions);
                $dataUpdate = [
                    'categories' => json_encode($categories),
                    'questions' => json_encode($questions),
                ];
                $result = SetQuestion::where(['id' => $id])->update($dataUpdate);
                return response()->json(['status' => $result], 200);
            }
            catch(Exception $ex){
                return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
            }
        }
    }
}
