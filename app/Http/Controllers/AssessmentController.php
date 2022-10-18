<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SetQuestion;
use App\Assessment;
use App\Category;
use App\SurveyResult;
use DB;
use Validator;
use Auth;
use App\User;
use App\CompanyInfo;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AssessmentController extends Controller
{
    //
    public function index(){
        $setQuestions = SetQuestion::all();
        $assessments = Assessment::paginate(10);
        return view('main.assessment.index', ['set_questions' => $setQuestions, 'assessments' => $assessments]);
    }

    public function create(Request $request){
        try{
            if($request->isMethod('POST')){
                $rules = [
                    'name' => 'required',
                    'set_question' => 'required',
                ];
                $user = Auth::user();
                $messages = [
                    'name.required'  => 'Tên không được để trống.',
                    'set_question.required'  => 'Bộ câu hỏi không được để trống.',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
                }
                $result = Assessment::create([
                    'name' => $request->name,
                    'set_question_id' => (int)$request->set_question,
                    'company_id' => $user->company_id,
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
            $rules = [
                'name' => 'required',
                'set_question' => 'required',
            ];
            $user = Auth::user();
            $messages = [
                'name.required'  => 'Tên không được để trống.',
                'set_question.required'  => 'Bộ câu hỏi không được để trống.',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
            }
            $result = Assessment::where(['id' => $id])->update([
                'name' => $request->name,
                'set_question_id' => (int)$request->set_question,
            ]);
            return response()->json(['status' => $result], 200);
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function detail($id){
        $assessment = Assessment::find($id);
        return response()->json(['data' => $assessment], 200);
    }

    public function reload(Request $request){
        $result = Assessment::query();
        $assessments = $result->paginate(10);
        return view('main.assessment.list', ['assessments' => $assessments])->render();
    }

    public function run($slug){
        $arraySlug = explode('-', $slug);
        $id = $arraySlug[0];
        $assessment = Assessment::find($id);
        $user = Auth::user();
        if($user->company_id == $assessment->company_id)return view('main.assessment.detail', ['assessment' => $assessment]);
        else return redirect()->route('assessment');
    }

    public function runCategory($slugAssessment, $slugCategory){
        $slugAssessment = explode('-', $slugAssessment);
        $assessmentID = $slugAssessment[0];
        $assessment = Assessment::find($assessmentID);

        $slugCategory = explode('-', $slugCategory);
        $categoryID = $slugCategory[0];
        $category = Category::find($categoryID);
        
        $user = Auth::user();
        $users = User::where('company_id', $assessment->company_id)->get();
        $listQuestionID = $category->getQuestion->modelKeys();

        $answers = SurveyResult::where(['assessment_id' => $assessment->id])->whereIn('question_id', $listQuestionID)->get();
        return view('main.assessment.list_question', ['assessment' => $assessment, 'category' => $category, 'users' => $users, 'answers' => $answers]);
    }

    public function saveLog(Request $request){
        try{
            $answer = !empty($request->answer) ? $request->answer : '';
            $assessment = Assessment::find((int)$request->assessment_id);
            $user = Auth::user();
            $log = [
                'answer' => $answer,
                // 'question_id' => (int)$request->question_id,
                // 'assessment_id' => (int)$request->assessment_id,
                // 'set_question_id' => $assessment->setQuestion->id,
                'user_id' => $user->id,
                'company_id' => $user->company_id,
            ];
            switch ($answer) {
                case 'yes':
                    if(!empty($request->yes_note))$log['yes_note'] = $request->yes_note;
                    if(empty($request->yes_attachment_name)) $log['yes_attachment'] = '';
                    if(!empty($request->file('yes_attachment'))){
                        $fileName = time() . '_' . $request->file('yes_attachment')->getClientOriginalName();  
                        $request->yes_attachment->move(public_path('uploads'), $fileName);
                        $log['yes_attachment'] = 'uploads/' . $fileName;
                    }
                    break;
                case 'no':
                    # code...
                    if(!empty($request->no_employee))$log['no_employee_id'] = (int)$request->no_employee;
                    if(!empty($request->no_date)){
                        $log['no_finish_date'] = Carbon::parse(strtotime(str_replace('/', '-', $request->no_date )))->setTimezone(config('app.timezone'));
                    }
                    break;
                case 'improve':
                    if(!empty($request->improve_note))$log['improve_note'] = $request->improve_note;
                    if(empty($request->improve_attachment_name)) $log['improve_attachment'] = '';
                    if(!empty($request->file('improve_attachment'))){
                        $fileName = time() . '_' . $request->file('improve_attachment')->getClientOriginalName();  
                        $request->improve_attachment->move(public_path('uploads'), $fileName);
                        $log['improve_attachment'] = 'uploads/' . $fileName;
                    }
                    if(!empty($request->improve_employee))$log['improve_employee_id'] = (int)$request->improve_employee;
                    if(!empty($request->improve_date)) {
                        $improve_date = Carbon::parse(strtotime(str_replace('/', '-', $request->improve_date )))->setTimezone(config('app.timezone'));
                        $log['improve_finish_date'] = $improve_date;
                    }
                    # code...
                    break;  
                default:
                    # code...
                    break;
            }
            $filter = [
                'question_id' => (int)$request->question_id,
                'assessment_id' => (int)$request->assessment_id,
                'set_question_id' => $assessment->setQuestion->id,
            ];
            $result = SurveyResult::updateOrCreate($filter, $log);
            if($result) return response()->json(['status' => $result], 200);
            else return response()->json(['status' => 0, 'msg' => 'Failed'], 200);
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMessage()], 200);
        }
    }

    public function updatePersonnel(Request $request){
        try{
            $user = Auth::user();
            $rules = [
                'assessment_id' => 'required',
                'total_personnel' => 'required',
                'total_women_personnel' => 'required',
                'total_group1' => 'required',
                'total_group2' => 'required',
                'total_group3' => 'required',
                'total_group4' => 'required',
                'total_group5' => 'required',
            ];
            $messages = [
                'assessment_id.required' => 'Kỳ đánh giá không được để trống',
                'total_personnel.required' => 'Tổng số lao động không được để trống',
                'total_women_personnel.required' => 'Tổng số lao động nữ không được để trống',
                'total_group1.required' => 'Tổng số cán bộ quản lý không được để trống',
                'total_group2.required' => 'Tổng nhân viên làm công tác ATVSLĐ không được để trống',
                'total_group3.required' => 'Tổng số nhân viên làm công việc có yêu cầu nghiêm ngặt về ATVSLĐ không được để trống',
                'total_group4.required' => 'Tổng số nhân viên làm còn lại không được để trống',
                'total_group5.required' => 'Tổng số nhân viên làm công tác y tế không được để trống',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['status' => 0, 'msg' => $errors->all()[0]], 200);
            }
            $data = [
                'user_id' => $user->id,
                'total_employee' => (int)$request->total_personnel, 
                'total_female_employee' => (int)$request->total_women_personnel, 
                'total_type_1' => (int)$request->total_group1, 
                'total_type_2' => (int)$request->total_group2, 
                'total_type_3' => (int)$request->total_group3, 
                'total_type_4' => (int)$request->total_group4, 
                'total_type_5' => (int)$request->total_group5
            ];
            $filter = [
                'assessment_id' => (int)$request->assessment_id,
                'company_id' => $user->company_id,
            ];

            $result = CompanyInfo::updateOrCreate($filter, $data);
            return response()->json(['status' => $result], 200);
        }
        catch(Exception $ex){
            return response()->json(['status' => 0, 'msg' => $ex->getMesssage()], 200);
        }
    }

    public function getCompanyInfo($assessment_id){
        $user = Auth::user();
        $companyID = $user->company_id;
        $companyInfo = CompanyInfo::where(['company_id' => $companyID, 'assessment_id' => $assessment_id])->first();
        return response()->json(['data' => !empty($companyInfo) ? $companyInfo : []], 200); 
    }

    public function result($slugAssessment, $slugCategory){
        $slugAssessment = explode('-', $slugAssessment);
        $assessmentID = $slugAssessment[0];
        $assessment = Assessment::find($assessmentID);

        $slugCategory = explode('-', $slugCategory);
        $categoryID = $slugCategory[0];
        $category = Category::find($categoryID);
        
        $user = Auth::user();
        $users = User::where('company_id', $assessment->company_id)->get();
        $listQuestionID = $category->getQuestion->modelKeys();

        $answers = SurveyResult::where(['assessment_id' => $assessment->id])->whereIn('question_id', $listQuestionID)->get();
        return view('main.assessment.result', ['assessment' => $assessment, 'category' => $category, 'users' => $users, 'answers' => $answers]);
    }
}
