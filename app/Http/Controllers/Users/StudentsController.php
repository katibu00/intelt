<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Institution;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{

    public function index(){
        $institution_id = Auth::user()->institution_id;
        // $institution = Institution::where('id', $institution_id)->first();
        // $data['type'] = $institution->type;
        $data['departments'] = Department::where('institution_id',$institution_id)->get()->sortBy('id');
        $data['levels'] = Level::where('institution_id',$institution_id)->get();
        $data['allData'] = User::where('institution_id',$institution_id)->where('usertype','student')->paginate(10);
        return view('users.students.index',$data);
    }

    public function paginate(Request $request)
    {
        // dd($request['query']);
        // dd($request->all());
        $institution_id = Auth::user()->institution_id;
        if($request['query'] != null){
            $data['allData'] = User::where('institution_id', $institution_id)->where('reg_number','like','%'.$request['query'].'%')->orWhere('first_name','like','%'.$request['query'].'%')->orWhere('last_name','like','%'.$request['query'].'%')->paginate(10);
        }
        // else{
        //     $data['allData'] = User::where('institution_id', $institution_id)->where('department_id','LIKE',$request['department_id'])->where('level_id','LIKE',$request['level'])->paginate(10);
        // }

        if($request['department_id'] != null && $request['query'] == null)
        {
            $data['allData'] = User::where('institution_id', $institution_id)->where('department_id',$request['department_id'])->paginate(10);  
        }

        if($request['query'] == null && $request['department_id'] == null && $request['level_id'] == null)
        {
            $data['allData'] = User::where('institution_id',$institution_id)->paginate(10);
        }
        return view('users.students.table', $data)->render();
    }

    public function search(Request $request)
    {
    
        $institution_id = Auth::user()->institution_id;
        $data['allData'] = User::where('institution_id', $institution_id)->where('reg_number','like','%'.$request['query'].'%')->orWhere('first_name','like','%'.$request['query'].'%')->orWhere('last_name','like','%'.$request['query'].'%')->paginate(10);
        
        if( $data['allData']->count() )
        {
            return view('users.students.table', $data)->render();
        }else
        {
            return response()->json([
                'status' => 404,
            ]);
        }
       
    }

    public function sort(Request $request)
    {
        // dd($request->all());
        $institution_id = Auth::user()->institution_id;
        $data['allData'] = User::where('institution_id', $institution_id)->where('department_id',$request['department_id'])->orWhere('level_id', $request['level'])->paginate(10);
        
        if( $data['allData']->count() )
        {
            return view('users.students.table', $data)->render();
        }else
        {
            return response()->json([
                'status' => 404,
            ]);
        }
       
    }

    public function create(){
        $institution_id = Auth::user()->institution_id;
        $institution = Institution::where('id', $institution_id)->first();
        $data['type'] = $institution->type;
        $data['departments'] = Department::where('institution_id',$institution_id)->get()->sortBy('id');
        $data['levels'] = Level::where('institution_id',$institution_id)->get();
        return view('users.students.create',$data);
    }

    public function store(Request $request){
   
 
        $institution_id = Auth::user()->institution_id;

        $dataCount = count($request->student);
        if($dataCount != NULL){
            for ($i=0; $i < $dataCount; $i++){
                $data = new User();
                $data->first_name =  $request['student'][$i]['first_name'];
                $data->middle_name =  $request['student'][$i]['middle_name'];
                $data->last_name =  $request['student'][$i]['last_name'];
                $data->institution_id = $institution_id;
                $data->reg_number =  $request['student'][$i]['reg_number'];
                $data->department_id = $request->department_id;
                $data->level_id = $request->level_id;
                $data->password = Hash::make(123);
                $data->save();
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Students Created Successfully',
        ]);
    }
}
