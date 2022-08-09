<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Category;
use Validator;

class QuestionController extends Controller
{
    public function index(){
        $questions = Question::paginate(20);
        return view('admin.question.index', ['questions' => $questions]);
    }

    public function create(Request $request){
        try{
            if($request->isMethod('POST')){
                $rules = [
                    'code' => 'required',
                    'category_id' => 'required',
                    'content' => 'required',
                    'approve_help' => 'required',
                    'term' => 'required',
                    'penalty' => 'required',
                    'guide' => 'required',
                ];
                $messages = [
                    'required'  => ':attribute không được để trống.',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return redirect()->back()->withErrors(['msg' => $errors->all()[0]]);
                }
                $result = Question::create([
                    'code' => $request->code,
                    'category_id' => $request->category_id,
                    'guide_attachment' => !empty($request->guide_attachment) ? $request->guide_attachment : '',
                    'sample_attachment' => !empty($request->sample_attachment) ? $request->sample_attachment : '',
                    'content' => $request->content,
                    'approve_help' => $request->approve_help,
                    'term' => $request->term,
                    'penalty' => $request->term,
                    'guide' => $request->term,
                    'answer_expression' => !empty($request->answer_expression) ? $request->answer_expression : '',
                    'tags' => !empty($request->tag) ? json_encode($request->tag) : '',
                    'status' => isset($request->status) ? 1 : 0
                ]);
                return redirect()->route('question');
            }
            else{
                $categories = Category::doesntHave('getSubCategory')->get();
                return view('admin.question.create', ['categories' => $categories]);
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
                    'code' => 'required',
                    'category_id' => 'required',
                    'content' => 'required',
                    'approve_help' => 'required',
                    'term' => 'required',
                    'penalty' => 'required',
                    'guide' => 'required',
                ];
                $messages = [
                    'required'  => ':attribute không được để trống.',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return redirect()->back()->withErrors(['msg' => $errors->all()[0]]);
                }
                $result = Question::where(['id' => $id])->update([
                    'code' => $request->code,
                    'category_id' => $request->category_id,
                    'guide_attachment' => !empty($request->guide_attachment) ? $request->guide_attachment : '',
                    'sample_attachment' => !empty($request->sample_attachment) ? $request->sample_attachment : '',
                    'content' => $request->content,
                    'approve_help' => $request->approve_help,
                    'term' => $request->term,
                    'penalty' => $request->term,
                    'guide' => $request->term,
                    'answer_expression' => !empty($request->answer_expression) ? $request->answer_expression : '',
                    'tags' => !empty($request->tag) ? json_encode($request->tag) : '',
                    'status' => isset($request->status) ? 1 : 0
                ]);
                return redirect()->route('question');
            }
            else{
                $categories = Category::doesntHave('getSubCategory')->get();
                $question = Question::find($id);
                return view('admin.question.update', ['categories' => $categories, 'question' => $question]);
            }
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function detail($id){
        $category = Category::find($id);
        return response()->json(['data' => $category], 200);
    }

    public function delete($id){
        $category = Category::find($id);
        $subs = $category->getSubCategory;
        $questions = $category->getQuestion;
        if($subs->isEmpty() && $questions->isEmpty()) {
            $result = $category->delete();
            return response()->json(['status' => $result], 200);
        }
        else return response()->json(['status' => 0, 'msg' => "Không thể xóa. Danh mục có câu hỏi hoặc danh mục con."], 200);
    }

    public function reload(){
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.category.list_category', ['categories' => $categories])->render();
    }
}
