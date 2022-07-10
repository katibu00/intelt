<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as File;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class InstitutionController extends Controller
{
    public function index()
    {
        $institution_id = Auth::user()->institution_id;
        $data['institution'] = Institution::where('id', $institution_id)->first();
        $data['sessions'] = Session::where('institution_id',$institution_id)->get();
        return view('settings.institution', $data);
    }

    public function basic(Request $request)
    {
        // dd($request->all());

       $validator = Validator::make($request->all(), [
        'name'=>'required',
        'address'=>'required',
        'phone'=>'required',
        'email'=>'required|email',
        'website'=>'required',
        'semester'=>'required',
        'session_id'=>'required',
    ]);
   
    if($validator->fails()){
        return response()->json([
            'status'=>400,
            'errors'=>$validator->messages(),
            'message'=>'Check your input and try again',
        ]);
    }
      
        $institution_id = Auth::user()->institution_id;
        $institution = Institution::FindorFail($institution_id);

        $institution->name = $request->name;
        $institution->motto = $request->motto;
        $institution->address = $request->address;
        $institution->phone = $request->phone;
        $institution->alternate_phone = $request->alternate_phone;
        $institution->website = $request->website;
        $institution->session_id = $request->session_id;
        $institution->semester = $request->semester;
       
        if ($request->file('logo') != null) {
            $destination = 'uploads/' . $institution->username . '/' . $institution->logo;
            File::delete($destination);
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/' . $institution->username, $filename);
            $institution->logo = $filename;
        }

        $institution->update();


        return response()->json([
            'status'=>200,
            'message'=>'Institution settings Updated sucessfully',
        ]);
    }

}
