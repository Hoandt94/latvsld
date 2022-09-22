<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::whereNull('parent_id')->orderBy('order', 'ASC')->get();
        return view('admin.category.index', ['categories' => $categories]);
    }

    public function create(Request $request){
        try{
            if($request->isMethod('POST')){
                $rules = [
                    'name' => 'required',
                    // 'code' => 'required',
                    'order' => 'required'
                ];
                $messages = [
                    'required'  => ':attribute không được để trống.',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
                }
                $result = Category::create([
                    'name' => $request->name,
                    'code' => !empty($request->code) ? $request->code : '',
                    'parent_id' => !empty($request->parent_id) ? $request->parent_id : null,
                    'order' => (int)$request->order,
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
                    // 'code' => 'required',
                    'order' => 'required'
                ];
                $messages = [
                    'required'  => ':attribute không được để trống.',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
                }
                $result = Category::where(['id' => $id])->update([
                    'name' => $request->name,
                    'code' => !empty($request->code) ? $request->code : '',
                    'order' => (int)$request->order,
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
        $category = Category::find($id);
        $category->parent_category = !empty($category->parentCategory) ? $category->parentCategory : [];
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
        $categories = Category::whereNull('parent_id')->orderBy('order', 'ASC')->get();
        return view('admin.category.list_category', ['categories' => $categories])->render();
    }
}
