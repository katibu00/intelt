<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use App\Models\Institution;
use App\Models\Level;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    public function index(){
        $institution_id = Auth::user()->institution_id;
        $institution = Institution::where('id', $institution_id)->first();
        $data['type'] = $institution->type;
        $data['departments'] = Department::where('institution_id',$institution_id)->get()->sortBy('id');
        $data['levels'] = Level::where('institution_id',$institution_id)->get();
        $data['allData'] = Course::where('institution_id',$institution_id)->paginate(5);
        return view('settings.courses.index',$data);
    }

    public function paginate(Request $request)
    {
        $institution_id = Auth::user()->institution_id;
        $data['allData'] = Course::where('institution_id', $institution_id)->where('course_code','like','%'.$request['query'].'%')->where('department_id','like','%'.$request['department_id'].'%')->where('level_order', 'like','%'.$request['level'].'%')->paginate(5);

        return view('settings.courses.table', $data)->render();
    }

    public function search(Request $request)
    {
    
        $institution_id = Auth::user()->institution_id;
        $data['allData'] = Course::where('institution_id', $institution_id)->where('course_code','like','%'.$request['query'].'%')->orWhere('course_title','like','%'.$request['query'].'%')->paginate(5);
        
        if( $data['allData']->count() )
        {
            return view('settings.courses.table', $data)->render();
        }else
        {
            return response()->json([
                'status' => 404,
            ]);
        }
       
    }

    public function sort(Request $request)
    {
        $institution_id = Auth::user()->institution_id;
        $data['allData'] = Course::where('institution_id', $institution_id)->where('department_id','like','%'.$request['department_id'].'%')->where('level_order', 'like','%'.$request['level'].'%')->paginate(5);
        
        if( $data['allData']->count() )
        {
            return view('settings.courses.table', $data)->render();
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
        $data['users'] = User::where('institution_id',$institution_id)->where('usertype','!=','intellisas')->where('usertype','!=','student')->where('usertype','!=','applicant')->get()->sortBy('name');
        return view('settings.courses.create',$data);
    }


    public function store(Request $request)
    {
        $department = implode(',',$request->department);

        $institution_id = Auth::user()->institution_id;
        $courseCount = count($request->course);
        if($courseCount != NULL){
            for ($i=0; $i < $courseCount; $i++){
                $course = new Course();
                $course->institution_id = $institution_id;
                $course->department_id = $department;
                $course->level_order = $request->level_order;
                $course->semester = $request->semester;
                $course->course_code = $request['course'][$i]['course_code'];
                $course->course_title = $request['course'][$i]['course_title'];
                $course->credit_unit = $request['course'][$i]['credit_unit'];
                $course->user_id = $request['course'][$i]['user_id'];
                $course->designation = $request['course'][$i]['designation'];
                $course->save();
            }
        }
        Toastr::success('Course has been Added sucessfully');
        return redirect()->route('courses.index');
    }


    public function details($dept,$level)
    {
            $institution_id = Auth::user()->institution_id;
            $data['firsts'] = Course::where('institution_id',$institution_id)->where('department_id',$dept)->where('level_order',$level)->where('semester','First')->get();
            $data['seconds'] = Course::where('institution_id',$institution_id)->where('department_id',$dept)->where('level_order',$level)->where('semester','Second')->get();
            $data['dept'] = Department::where('institution_id',$institution_id)->where('id',$dept)->first();
            $data['level'] = Level::where('institution_id',$institution_id)->where('order',$level)->first();

            if($data['firsts']->count() == 0 &&  $data['seconds']->count() == 0){
                Toastr::error(' First and Second Semester Courses have not been added','Warning');
                return redirect()->back();
            }
            if($data['firsts']->count() == 0 ||  $data['seconds']->count() == 0){
                Toastr::error('One of the Semester Courses have not been added','Warning');
                
            }
            return view('settings.courses.viewDetails',$data);

    }

    public function edit($id){
            $institution_id = Auth::user()->institution_id;
            $institution = Institution::where('id', $institution_id)->first();
            $data['departments'] = Department::where('institution_id',$institution_id)->get()->sortBy('id');
            $data['levels'] = Level::where('institution_id',$institution_id)->get();
            $data['course'] = Course::findorFail($id);
            $data['users'] = User::where('institution_id',$institution_id)->where('usertype','!=','intellisas')->where('usertype','!=','student')->where('usertype','!=','applicant')->get()->sortBy('name');
            return view('settings.courses.updateCourse',$data);
    }


    public function update(Request $request, $id)
    {

            $course = Course::findOrFail($id);
            $course->course_code = $request->course_code;
            $course->course_title = $request->course_title;
            $course->credit_unit = $request->credit_unit;
            $course->user_id = $request->user_id;
            $course->designation = $request->designation;
            $course->update();
            
            Toastr::success('Course has been Updated sucessfully');
            return redirect()->route('courses.index');
    }


    public function delete(Request $request){

        $data = Course::find($request->id);

        if($data->delete()){

            return response()->json([
                'status' => 200,
                'message' => 'Course Deleted Successfully'
            ]);

        };
    
    }
}
