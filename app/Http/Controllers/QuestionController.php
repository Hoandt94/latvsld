<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Category;
use Validator;
use DB;
class QuestionController extends Controller
{
    public function index(){
        $questions = Question::paginate(15);
        $categories = Category::doesntHave('getSubCategory')->get();
        return view('admin.question.index', ['questions' => $questions, 'categories' => $categories]);
    }

    public function create(Request $request){
        try{
            if($request->isMethod('POST')){
                $rules = [
                    'order' => 'required',
                    'category_id' => 'required',
                    'content' => 'required',
                    'approve_help' => 'required',
                    'term' => 'required',
                    'penalty_min' => 'required',
                    'penalty_max' => 'required',
                    'guide' => 'required',
                    'required' => 'required',
                ];
                $messages = [
                    'category_id.required'  => 'Danh mục không được để trống.',
                    'content.required'  => 'Nội dung không được để trống.',
                    'approve_help.required'  => 'Bằng chứng tuân thủ không được để trống.',
                    'term.required'  => 'Điều khoản căn cứ không được để trống.',
                    'penalty_min.required'  => 'Hình thức xử phạt không được để trống.',
                    'penalty_max.required'  => 'Hình thức xử phạt không được để trống.',
                    'guide.required'  => 'Hướng dẫn thực hiện không được để trống.',
                    'required.required'  => 'Yêu cầu thực hiện không được để trống.',
                    'order.required'  => 'Vị trí không được để trống.',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return redirect()->back()->withErrors(['msg' => $errors->all()[0]]);
                }
                if(count($request->penalty_min) != count($request->term) || count($request->penalty_max) != count($request->term)) return redirect()->back()->withErrors(['msg' => 'Vui lòng nhập đầy đủ điều khoản căn cứ và hình thức xử phạt.']);
                $result = Question::create([
                    'code' => !empty($request->code) ? $request->code : '',
                    'category_id' => $request->category_id,
                    'guide_attachment' => !empty($request->guide_attachment) ? $request->guide_attachment : '',
                    'sample_attachment' => !empty($request->sample_attachment) ? $request->sample_attachment : '',
                    'content' => $request->content,
                    'approve_help' => $request->approve_help,
                    'term' => json_encode($request->term),
                    'penalty_min' => json_encode($request->penalty_min),
                    'penalty_max' => json_encode($request->penalty_max),
                    'guide' => $request->guide,
                    'required' => $request->required,
                    'order' => $request->order,
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
                    // 'code' => 'required',
                    'category_id' => 'required',
                    'content' => 'required',
                    'approve_help' => 'required',
                    'term' => 'required',
                    'penalty_min' => 'required',
                    'penalty_max' => 'required',
                    'guide' => 'required',
                    'required' => 'required',
                    'order' => 'required',
                ];
                $messages = [
                    'category_id.required'  => 'Danh mục không được để trống.',
                    'content.required'  => 'Nội dung không được để trống.',
                    'approve_help.required'  => 'Bằng chứng tuân thủ không được để trống.',
                    'term.required'  => 'Điều khoản căn cứ không được để trống.',
                    'penalty_min.required'  => 'Hình thức xử phạt không được để trống.',
                    'penalty_max.required'  => 'Hình thức xử phạt không được để trống.',
                    'guide.required'  => 'Hướng dẫn thực hiện không được để trống.',
                    'required.required'  => 'Yêu cầu thực hiện không được để trống.',
                    'order.required'  => 'Vị trí không được để trống.',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return redirect()->back()->withErrors(['msg' => $errors->all()[0]]);
                }
                if(count($request->penalty_min) != count($request->term) || count($request->penalty_max) != count($request->term)) return redirect()->back()->withErrors(['msg' => 'Vui lòng nhập đầy đủ điều khoản căn cứ và hình thức xử phạt.']);
                $result = Question::where(['id' => $id])->update([
                    'code' => !empty($request->code) ? $request->code : '',
                    'category_id' => $request->category_id,
                    'guide_attachment' => !empty($request->guide_attachment) ? $request->guide_attachment : '',
                    'sample_attachment' => !empty($request->sample_attachment) ? $request->sample_attachment : '',
                    'content' => $request->content,
                    'approve_help' => $request->approve_help,
                    'term' => json_encode($request->term),
                    'penalty_min' => json_encode($request->penalty_min),
                    'penalty_max' => json_encode($request->penalty_max),
                    'guide' => $request->guide,
                    'required' => $request->required,
                    'order' => $request->order,
                    'answer_expression' => !empty($request->answer_expression) ? $request->answer_expression : '',
                    'tags' => !empty($request->tag) ? json_encode($request->tag) : '',
                    'status' => isset($request->status) ? 1 : 0
                ]);
                return redirect()->back();
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

    public function reload(Request $request){
        $result = Question::query();
        if(!empty($request->category_id)) $result->where('category_id', (int)$request->category_id);
        if(!empty($request->code)) $result->where('code', 'like', '%' . $request->code . '%');
        if(!empty($request->content)) $result->where('content', 'like', '%' . $request->content . '%');
        $questions = $result->paginate(15);
        return view('admin.question.list', ['questions' => $questions])->render();
    }
}
