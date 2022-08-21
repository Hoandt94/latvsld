<?php

namespace App\Http\Controllers;
use App\SpecificProfession;
use Illuminate\Http\Request;
use Validator;

class SpecificProfessionController extends Controller
{
    public function index(){
        $jobs = SpecificProfession::paginate(10);
        return view('admin.specific_profession.index', ['jobs' => $jobs]);
    }

    public function create(Request $request){
        try{
            $rules = [
                'name' => 'required',
                'code' => 'required|unique:specific_professions',
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
            $result = SpecificProfession::create([
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
                'name' => 'required|unique:users',
                'code' => 'required|unique:specific_professions,code,' . $id,
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
            $result = SpecificProfession::where(['id' => $id])->update([
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
        $type = SpecificProfession::find($userID);
        return response()->json(['data' => $type], 200);
    }

    public function reload(Request $request){
        $jobs = SpecificProfession::query();
        if(!empty($request->code)) $jobs->where('code', 'like', '%' . $request->code . '%');
        if(!empty($request->name)) $jobs->where('name', 'like', '%' . $request->name . '%');
        $jobs = $jobs->paginate(10);
        return view('admin.specific_profession.list', ['jobs' => $jobs])->render();
    }
}
