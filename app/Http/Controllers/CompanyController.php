<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Validator;

class CompanyController extends Controller
{
    //
    public function index(){
        $companies = Company::paginate(10);
        return view('admin.company.index', ['companies' => $companies]);
    }

    public function create(Request $request){
        try{
            $rules = [
                'name' => 'required|unique:users',
                'code' => 'required|unique:companies',
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
            $result = Company::create([
                'name' => $request->name,
                'code' => $request->code,
                'status' => isset($request->status) ? 1 : 0
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
                'code' => 'required|unique:companies,code,' . $id,
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
            $result = Company::where(['id' => $id])->update([
                'name' => $request->name,
                'code' => $request->code,
                'status' => isset($request->status) ? 1 : 0
            ]);
            return response()->json(['status' => $result], 200);
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function detail($userID){
        $type = Company::find($userID);
        return response()->json(['data' => $type], 200);
    }

    public function reload(Request $request){
        $companies = Company::query();
        if(!empty($request->code)) $companies->where('code', 'like', '%' . $request->code . '%');
        if(!empty($request->name)) $companies->where('name', 'like', '%' . $request->name . '%');
        $companies = $companies->paginate(10);
        return view('admin.company.list', ['companies' => $companies])->render();
    }
}
