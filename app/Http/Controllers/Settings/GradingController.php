<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use App\Models\Grade;
use App\Models\Institution;
use App\Models\Level;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradingController extends Controller
{
    public function index(){
        $institution_id = Auth::user()->institution_id;
      
        $data['allData'] = Grade::where('institution_id',$institution_id)->get();
        return view('settings.grading.index',$data);
    }

    public function create(){
      
        return view('settings.grading.create');
    }


    public function store(Request $request)
    {

        $institution_id = Auth::user()->institution_id;
        $dataCount = count($request->row);
        if($dataCount != NULL){
            for ($i=0; $i < $dataCount; $i++){
                $data = new Grade();
                $data->institution_id = $institution_id;
                $data->start_mark = $request['row'][$i]['start_mark'];
                $data->end_mark = $request['row'][$i]['end_mark'];
                $data->letter_grade = $request['row'][$i]['letter_grade'];
                $data->numerical_grade = $request['row'][$i]['numerical_grade'];
                $data->remarks = $request['row'][$i]['remarks'];
                $data->save();
            }
        }
        Toastr::success('Grading Scheme has been Added sucessfully');
        return redirect()->route('grading.index');
    }
}
