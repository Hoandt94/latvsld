<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServicePack;
use Validator;

class ServicePackController extends Controller
{
    //
    //
    public function index(){
        $service_packs = ServicePack::paginate(10);
        return view('admin.service_pack.index', ['service_packs' => $service_packs]);
    }

    public function create(Request $request){
        try{
            $rules = [
                'name' => 'required',
                'price' => 'required|numeric',
            ];
              
            $messages = [
                'name.required'  => 'Tên không được để trống.',
                'price.required'  => 'Giá không được để trống.',
                'price.numeric'    => 'Giá phải là số',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
            }
            $result = ServicePack::create([
                'name' => $request->name,
                'description' => !empty($request->description) ? $request->description : '',
                'price' => $request->price,
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
                'price' => 'required|numeric',
            ];
              
            $messages = [
                'name.required'  => 'Tên không được để trống.',
                'price.required'  => 'Giá không được để trống.',
                'price.numeric'    => 'Giá phải là số',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
            }
            $result = ServicePack::where(['id' => $id])->update([
                'name' => $request->name,
                'description' => !empty($request->description) ? $request->description : '',
                'price' => $request->price,
                'status' => isset($request->status) ? 1 : 0
            ]);
            return response()->json(['status' => $result], 200);
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function detail($userID){
        $pack = ServicePack::find($userID);
        return response()->json(['data' => $pack], 200);
    }

    public function reload(Request $request){
        $service_packs = ServicePack::query();
        if(!empty($request->code)) $service_packs->where('code', 'like', '%' . $request->code . '%');
        if(!empty($request->name)) $service_packs->where('name', 'like', '%' . $request->name . '%');
        $service_packs = $service_packs->paginate(10);
        return view('admin.service_pack.list', ['service_packs' => $service_packs])->render();
    }
}
