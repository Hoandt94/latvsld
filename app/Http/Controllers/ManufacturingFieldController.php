<?php

namespace App\Http\Controllers;
use App\ManufacturingField;
use Illuminate\Http\Request;
use Validator;

class ManufacturingFieldController extends Controller
{
    public function index(){
        $fields = ManufacturingField::paginate(15);
        return view('admin.manufacturing_field.index', ['fields' => $fields]);
    }

    public function create(Request $request){
        try{
            $rules = [
                'name' => 'required',
                'code' => 'required|unique:manufacturing_fields',
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
            $result = ManufacturingField::create([
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
                'code' => 'required|unique:manufacturing_fields,code,' . $id,
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
            $result = ManufacturingField::where(['id' => $id])->update([
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
        $type = ManufacturingField::find($userID);
        return response()->json(['data' => $type], 200);
    }

    public function reload(){
        $fields = ManufacturingField::paginate(15);
        return view('admin.manufacturing_field.list', ['fields' => $fields])->render();
    }
}
