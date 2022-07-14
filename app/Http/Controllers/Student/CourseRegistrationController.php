<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CRF;
use App\Models\Institution;
use App\Models\Level;
use App\Models\StoredCO;
use App\Models\StudentProgress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseRegistrationController extends Controller
{
    public function index(){
   
        $institution_id = Auth::user()->institution_id;
        $institution = Institution::where('id', $institution_id)->first();
        $data['type'] = $institution->type;
        $data['levels'] = Level::where('institution_id',$institution_id)->get();
      
        return view('student.course_registration.index',$data);
    }

    public function getRecommeded(Request $request){
   
        // return $request->all();
        // $institution_id = Auth::user()->institution_id;
        // $institution = Institution::where('id', $institution_id)->first();
        $user = User::find(Auth::user()->id);
      

        $regulars = Course::where('institution_id',$user->institution_id)->where('department_id','LIKE','%'.$user->department_id.'%')->where('level_order',$request->level)->where('semester',$request->semester)->where('designation','C')->get();
        $electives = Course::where('institution_id',$user->institution_id)->where('department_id','LIKE','%'.$user->department_id.'%')->where('level_order',$request->level)->where('semester',$request->semester)->where('designation','E')->get();
        $cos = StoredCO::with('course')->where('institution_id',$user->institution_id)->where('user_id',$user->id)->where('cleared',null)->get();

        return response()->json([
            'status' => 200,
            'regulars' => $regulars,
            'electives' => $electives,
            'cos' => $cos,
        ]);
    }


    
    public function registerCourses(Request $request){

        if(!$request->has('course_id')){
            return response()->json([
                'status' => 400,
                'message' => 'Please Select at least One Course',
            ]);
        }
        $user = Auth::user();
        $institution = Institution::where('id', $user->institution_id)->first();

        $progress = StudentProgress::where('institution_id',$institution->id)->where('session_id',$institution->session_id)->where('user_id',$user->id)->first();
        if(!$progress || $progress->profile != 1){
            return response()->json([
                'status' => 400,
                'message' => 'Please Update your profile first.',
            ]);
        }
        if($progress->courses == 1){
            return response()->json([
                'status' => 400,
                'message' => 'You have already Submitted Your Courses.',
            ]);
        }

        $courseCount = count($request->course_id);

        if($courseCount != NULL){
            for ($i=0; $i < $courseCount; $i++){

                $type = null;
                $isCO = StoredCO::where('user_id',$user->id)->where('course_id',$request->course_id[$i])->where('cleared',null)->first();
                if($isCO)
                {
                    $type = 'CO';
                }
                $course = new CRF();
                $course->institution_id = $user->institution_id;
                $course->user_id = $user->id;
                $course->session_id = $institution->session_id;
                $course->semester = $institution->semester;
                $course->level_order = $user['level']['order'];
                $course->course_id = $request->course_id[$i];
                $course->type = $type;
                $course->save();
            }
        }

        $progress->courses = 1;
        $progress->update();

        return response()->json([
            'status' => 200,
            'message' => 'Course Registered Successfully',
        ]);
    }
}
