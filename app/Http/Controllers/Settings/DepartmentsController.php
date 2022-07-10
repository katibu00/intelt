<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepartmentsController extends Controller
{
    public function index()
    {
        $institution_id = Auth::user()->institution_id;
        $data['allData'] = Department::where('institution_id', $institution_id)->paginate(5);
        $data['institution_type'] = Institution::FindorFail($institution_id)->type;
        return view('settings.departments.index', $data);
    }

    public function paginate(Request $request)
    {
        $institution_id = Auth::user()->institution_id;
        $data['allData'] = Department::where('institution_id', $institution_id)->paginate(5);       
        return view('settings.departments.table', $data)->render();
    }
    public function search(Request $request)
    {
    
        $institution_id = Auth::user()->institution_id;
        $data['allData'] = Department::where('institution_id', $institution_id)->where('name','like','%'.$request['query'].'%')->paginate(5);
        
        if( $data['allData']->count() )
        {
            return view('settings.departments.table', $data)->render();
        }else
        {
            return response()->json([
                'status' => 404,
            ]);
        }
       
    }


    public function store(Request $request)
    {
        $institution_id = Auth::user()->institution_id;
        $institution_type = Institution::FindorFail($institution_id)->type;

        $validator = Validator::make($request->all(), [
            'name'=>'required|max:191',
        ]);
       
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{

            $data = new Department();
            $data->name = $request->name;
            $data->institution_id = $institution_id;
            $data->save();
          

            if($institution_type == 'university')
            {
                return response()->json([
                    'status'=>200,
                    'message'=>'Department Added Successfully'
                ]);
            }elseif($institution_type == 'nce')
            {
                return response()->json([
                    'status'=>200,
                    'message'=>'Department Added Successfully'
                ]);
            }else
            {
                return response()->json([
                    'status'=>200,
                    'message'=>'Course Added Successfully'
                ]); 
            }

        }
    }

 

    public function update(Request $request)
    {
        $institution_id = Auth::user()->institution_id;
        $institution_type = Institution::FindorFail($institution_id)->type;

        $validator = Validator::make($request->all(), [
            'update_name'=>'required|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{

            $form_data = array(
                'name' => $request->update_name,
            );
            Department::whereId($request->update_id)->update($form_data);
    
            if($institution_type == 'university')
            {
                return response()->json([
                    'status'=>200,
                    'message'=>'Department Updated Successfully'
                ]);
            }elseif($institution_type == 'nce')
            {
                return response()->json([
                    'status'=>200,
                    'message'=>'Department Updated Successfully'
                ]);
            }else
            {
                return response()->json([
                    'status'=>200,
                    'message'=>'Course Updated Successfully'
                ]); 
            }

        }
       
    }

    public function delete(Request $request)
    {
        $institution_id = Auth::user()->institution_id;
        $institution_type = Institution::FindorFail($institution_id)->type;

        $data = Department::findOrFail($request->delete_id);
        if( $data->delete()){
          
            if($institution_type == 'university')
            {
                return response()->json([
                    'status'=>200,
                    'message'=>'Department Deleted Successfully'
                ]);
            }elseif($institution_type == 'nce')
            {
                return response()->json([
                    'status'=>200,
                    'message'=>'Department Deleted Successfully'
                ]);
            }else
            {
                return response()->json([
                    'status'=>200,
                    'message'=>'Course Deleted Successfully'
                ]); 
            }
        }
    }
}
