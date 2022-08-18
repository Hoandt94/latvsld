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
                'name' => 'required|unique:users',
                'code' => 'required|unique:business_types',
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
            $result = BusinessType::create([
                'name' => $request->name,
                'code' => $request->code,
            ]);
            return response()->json(['status' => $result], 200);
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function update($id, Request $request){
        try{
            $rules = [
                'name' => 'required',
                'code' => 'required|unique:business_types,code,' . $id,
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
            $result = BusinessType::where(['id' => $id])->update([
                'name' => $request->name,
                'code' => $request->code,
            ]);
            return response()->json(['status' => $result], 200);
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function detail($userID){
        $type = BusinessType::find($userID);
        return response()->json(['data' => $type], 200);
    }

    public function reload(Request $request){
        $types = BusinessType::query();
        if(!empty($request->code)) $types->where('code', 'like', '%' . $request->code . '%');
        if(!empty($request->name)) $types->where('name', 'like', '%' . $request->name . '%');
        $types = $types->paginate(15);
        return view('admin.business_type.list', ['types' => $types])->render();
    }
}
