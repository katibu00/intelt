<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CRF;
use App\Models\Department;
use App\Models\Institution;
use App\Models\Level;
use App\Models\Mark;
use App\Models\Session;
use App\Models\StudentProgress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class ResultSummaryController extends Controller
{
    public function index()
    {
        $institution_id = Auth::user()->institution_id;
        $data['institution'] = Institution::where('id', $institution_id)->first();
        $data['levels'] = Level::where('institution_id',$institution_id)->get();
        $data['sessions'] = Session::where('institution_id',$institution_id)->get();
        $data['departments'] = Department::where('institution_id',$institution_id)->get();
        return view('result.summary',$data);
    }

    public function generate(Request $request)
    {
        $user = Auth::user();
        $department = $request->department_id;
        $data['institution'] = Institution::where('id', $user->institution_id)->first();
        $data['students'] = Mark::select('user_id')
                                ->where('institution_id', $user->institution_id)
                                ->where('session_id', $request->session_id)
                                ->where('level_order', $request->level_order)
                                ->where('semester', $request->semester)
                                ->whereHas('student', function ($query) use ($department) {
                                    $query->where('department_id', $department);
                                })
                                ->groupBy('user_id')->get();
        if( $data['students']->count() == 0)
        {
            return response()->json([
                'status' => 104,
                'message' => 'No Marked Students have been Found.'
            ]);
        }
        $data['session_id'] = $request->session_id;
        $pdf = Pdf::loadView('pdf.result.others.summary.first', $data)->setPaper('a4', 'landscape');;
        $path = public_path('pdf/');
        $fileName = time().'.'.'pdf';
        $pdf->save($fileName);
        $pdf = public_path($fileName);
        return response()->download($pdf);
    }
}
