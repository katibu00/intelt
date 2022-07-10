<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CRF;
use App\Models\Institution;
use App\Models\Level;
use App\Models\Mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentResultController extends Controller
{
    public function index()
    {
   
        $institution_id = Auth::user()->institution_id;
        $data['levels'] = Level::where('institution_id',$institution_id)->get();
        return view('student.result.index',$data);
    }


    public function generate(Request $request)
    {
          $data['user'] = Auth::user();

          //First Semester
          if($request->level_order == 1 && $request->semester == 'first') 
          {
            $data['institution'] = Institution::where('id', $data['user']->institution_id)->first();
            $data['registered'] = CRF::where('user_id', $data['user']->id)->where('level_order', 1)->where('semester', 'First')->get();
            $pdf = Pdf::loadView('pdf.result.others.first', $data);
            $path = public_path('pdf/');
            $fileName = time().'.'.'pdf';
            $pdf->save($fileName);
            $pdf = public_path($fileName);
            return response()->download($pdf);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Error Occured',
        ]);
    }
}
