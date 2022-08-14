<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessType;
use Validator;

class BusinessTypeController extends Controller
{
    //
    public function index(){
        $businessTypes = BusinessType::paginate(15);
        return view('admin.business_type.index', ['types' => $businessTypes]);
    }

    public function create(Request $request){
        try{
            $rules = [
                'username' => 'required|unique:users',
                'password' => 'required|min:6',
                'name' => 'required'
            ];
              
            $messages = [
                'required'  => ':attribute không được để trống.',
                'unique'    => ':attribute đã được sử dụng',
                'min'       => ':attribute tối thiểu :min',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
            }
            $result = User::create([
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
            return response()->json(['status' => $result], 200);
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function update($user_id, Request $request){
        try{
            $rules = [
                'username' => 'required|unique:users,username,' . $user_id,
                'name' => 'required'
            ];
              
            $messages = [
                'required'  => ':attribute không được để trống.',
                'unique'    => ':attribute đã được sử dụng',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
            }
            $result = User::where(['id' => $user_id])->update([
                'username' => $request->username,
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
            return response()->json(['status' => $result], 200);
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function detail($userID){
        $user = User::find($userID);
        return response()->json(['data' => $user], 200);
    }

    public function reload(){
        $users = User::paginate(15);
        return view('admin.user.list_category', ['users' => $users])->render();
    }

    public function login(){
        return view('login');
    }

    public function postLogin(Request $request){
        $login = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::attempt($login)) {
            return redirect('/admin');
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }
}