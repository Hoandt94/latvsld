<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.category.index', ['categories' => $categories]);
    }

    public function create(Request $request){
        try{
            if($request->isMethod('POST')){
                $rules = [
                    'name' => 'required',
                    'code' => 'required',
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
                    'code' => $request->code,
                    'parent_id' => !empty($request->parent_id) ? $request->parent_id : null,
                    'order' => (int)$request->order,
                ]);
                return response()->json(['status' => $result], 200);
            }
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function update($user_id, Request $request){
        if($request->isMethod('get')){
            $user = User::find($user_id);
            return view('admin.user.update', ['user' => $user]);
        }
        else{
            $rules = [
                'username' => 'required|unique:users,username,' . $user_id,
                'name' => 'required'
            ];
              
            $messages = [
                'required'  => ':attribute không được để trống.',
                'unique'    => ':attribute đã được sử dụng',
            ];
            $result = $request->validate($rules, $messages);
            
            $result = User::where(['id' => $user_id])->update([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'name' => $request->name,
                'phone' => !empty($request->phone) ? $request->phone : '',
                'company' => !empty($request->company) ? $request->company : '',
                'position' => !empty($request->position) ? $request->position : '',
                'email' => !empty($request->email) ? $request->email : '',
                'role' => !empty($request->role) ? $request->role : 'user',
                'license_type' => !empty($request->license_type) ? $request->license_type : 1,
                'specific_professions' => !empty($request->specific_professions) ? $request->specific_professions : '',
                'status' => !empty($request->status) ? (int)$request->status : 1,
            ]);
            if($result) return redirect('/admin/users');
            else return redirect()->back()->with(['msg' => 'Có lỗi khi update']);
        }
    }

    public function detail($id){
        $category = Category::find($id);
        return response()->json(['data' => $category], 200);
    }

    public function delete($id){
        $category = Category::find($id);
        $subs = $category->getSubCategory;
        // if(!empty($subs)) 
    }
}
