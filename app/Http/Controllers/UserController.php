<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::paginate(15);
        return view('admin.user.index');
    }

    public function create(Request $request){
        if($request->isMethod('get'))return view('admin.user.create');
        else{
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
            $request->validate($rules, $messages);
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
            dd($result);
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

    public function detail(){

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
