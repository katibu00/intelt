<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CRF;
use App\Models\Institution;
use App\Models\Mark;
use App\Models\MarksSubmit;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarksController extends Controller
{
    public function create(){

        $user_id = Auth::user()->id;
        $school_id = Auth::user()->institution_id;
        $data['school'] = Institution::where('id', $school_id)->first();
        $data['courses'] = Course::where('user_id',$user_id)->get();
        return view('marks.create', $data);
    }

    public function getMarks(Request $request)
    {

        $school_id = Auth::user()->institution_id;
        $institution = Institution::where('id', $school_id)->first();
        $semester = $institution->semester;
        $session = $institution->session_id;
        $user_id = Auth::user()->id;
 
        $data['courses'] = Course::where('user_id',$user_id)->get();
        $data['course_id'] = $request->course_id;
        $data['marks_category'] = $request->marks_category;

    
        $data['students'] = Mark::with(['student','level'])->where('institution_id',$school_id)->where('course_id', $request->course_id)->where('type',$request->marks_category)->where('session_id',$session)->where('semester',$semester)->orderBy('user_id','ASC')->get();

        if($data['students']->count() > 0){

            $submitted = MarksSubmit::where('institution_id',$institution->id)
                                ->where('session_id',$institution->session_id)
                                ->where('semester',$institution->semester)
                                ->where('course_id',$request->course_id)
                                ->where('marks_category',$request->marks_category)
                                ->first();
            if($submitted){
                $data['submitted'] = 'yes';
            }

            $data['marked'] = Mark::where('institution_id',$institution->id)
             ->where('session_id',$institution->session_id)
             ->where('semester',$institution->semester)
             ->where('course_id',$request->course_id)
             ->where('type',$request->marks_category)
             ->where('marks','!=',null)->get()->count();

            return view('marks.create', $data);
        }else{
            $data['initial'] = 'yes'; 
            $data['students'] = CRF::with(['student','level'])->where('institution_id',$school_id)->where('course_id', $request->course_id)->where('session_id',$session)->where('semester',$semester)->orderBy('user_id','ASC')->get();
            return view('marks.create', $data);
        }
       
    }


    public function initializeMarks(Request $request){
        // dd($request->all());

        $user = Auth::user();
        $institution = Institution::where('id', $user->institution_id)->first();

        $check = Mark::where('institution_id',$institution->id)->where('session_id',$institution->session_id)->where('semester',$institution->semester)->where('course_id',$request->course_id)->where('type',$request->marks_category)->first();

        if($check){
            return response()->json([
                'status' => 404,
                'message' => 'Marks have already been Initialized',
            ]);
        }
        $dataCount = count($request->user_id);

        if($dataCount != NULL){
            for ($i=0; $i < $dataCount; $i++){
                $data = new Mark();
                $data->institution_id = $user->institution_id;
                $data->user_id = $request->user_id[$i];
                $data->session_id = $institution->session_id;
                $data->semester = $institution->semester;
                $user = User::find($request->user_id[$i]);
                $data->level_order = $user['level']['order'];
                $data->type = $request->marks_category;
                $data->course_id = $request->course_id;
                $data->save();
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Marks Initialized Successfully',
        ]);
    }


    public function saveMarks(Request $request){
        // dd($request->all());


        $user = Auth::user();
        $institution = Institution::where('id', $user->institution_id)->first();

        $check = Mark::where('institution_id',$institution->id)->where('session_id',$institution->session_id)->where('semester',$institution->semester)->where('user_id',$request->user_id)->where('course_id',$request->course_id)->where('type',$request->marks_category)->first();

        $marked = Mark::where('institution_id',$institution->id)
                        ->where('session_id',$institution->session_id)
                        ->where('semester',$institution->semester)
                        ->where('course_id',$request->course_id)
                        ->where('type',$request->marks_category)
                        ->where('marks','!=',null)
                        ->get()->count();

        if($check != null){
           
            $check->marks = $request->marks;
            $check->update();

            return response()->json([
                'status' => 200,
                'marked' => $marked,
                'message' => 'Saved as draft',
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Problem occured. Please initiliaze marks entry first',
            ]);
        }
    }



    public function submitMarks(Request $request){

        $user = Auth::user();
        $institution = Institution::where('id', $user->institution_id)->first();

        $submitexists = MarksSubmit::where('institution_id',$institution->id)
                            ->where('session_id',$institution->session_id)
                            ->where('semester',$institution->semester)
                            ->where('course_id',$request->course_id)
                            ->where('marks_category',$request->marks_category)
                            ->first();
        $unmarkedexists = Mark::where('institution_id',$institution->id)
                            ->where('session_id',$institution->session_id)
                            ->where('semester',$institution->semester)
                            ->where('course_id',$request->course_id)
                            ->where('type',$request->marks_category)
                            ->where('absent',null)
                            ->where('marks',null)
                            ->first();
                            
       if($submitexists){
        return response()->json([
            'status' => 200,
            'type' => 'error',
            'message' => 'Marks have already been Submitted',
        ]);
       }
       if($unmarkedexists){
        return response()->json([
            'status' => 404,
            'type' => 'warning',
            'message' => 'Some student(s) have not been marked. Give marks or mark absent for every student before submitting the marks',
        ]);
       }

        $insert = new MarksSubmit();
        $insert->institution_id = $institution->id;
        $insert->session_id = $institution->session_id;
        $insert->semester = $institution->semester;
        $insert->user_id = $user->id;
        $insert->course_id = $request->course_id;
        $insert->marks_category = $request->marks_category;
        $insert->save();

        return response()->json([
            'status' => 200,
            'type' => 'success',
            'message' => 'Marks submitted successfully',
        ]);
    }

    public function  checkAbsentMarks(Request $request)
    {

        $user = Auth::user();
        $institution = Institution::where('id', $user->institution_id)->first();

        $check = Mark::where('institution_id',$institution->id)->where('session_id',$institution->session_id)->where('semester',$institution->semester)->where('user_id',$request->user_id)->where('course_id',$request->course_id)->where('type',$request->marks_category)->first();

        $marked = Mark::where('institution_id',$institution->id)->where('session_id',$institution->session_id)->where('semester',$institution->semester)->where('course_id',$request->course_id)->where('type',$request->marks_category)->where('marks','!=','')->get()->count();

        if($check != null){
           
            $check->marks = 0;
            $check->absent = 'absent';
            $check->update();

            return response()->json([
                'status' => 200,
                'marked' => $marked,
                'type' => 'warning',
                'message' => 'Student marked as absent',
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'type' => 'error',
                'message' => 'Problem occured. Please initiliaze marks entry first',
            ]);
        }
        
    }


    public function  uncheckAbsentMarks(Request $request)
    {
        // dd($request->all());


        $user = Auth::user();
        $institution = Institution::where('id', $user->institution_id)->first();

        $check = Mark::where('institution_id',$institution->id)->where('session_id',$institution->session_id)->where('semester',$institution->semester)->where('user_id',$request->user_id)->where('course_id',$request->course_id)->where('type',$request->marks_category)->first();

        $marked = Mark::where('institution_id',$institution->id)->where('session_id',$institution->session_id)->where('semester',$institution->semester)->where('course_id',$request->course_id)->where('type',$request->marks_category)->where('marks','!=','')->get()->count();

        if($check != null){
           
            $check->marks = $request->marks;
            $check->absent = null;
            $check->update();

            return response()->json([
                'status' => 200,
                'marked' => $marked,
                'message' => 'Student Marks restored',
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Problem occured. Please initiliaze marks entry first',
            ]);
        }
        
    }
}
