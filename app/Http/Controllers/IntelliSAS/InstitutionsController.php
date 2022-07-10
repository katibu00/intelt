<?php

namespace App\Http\Controllers\IntelliSAS;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\Session;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File as File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InstitutionsController extends Controller
{
    public function index(){
        $data['institutions'] = Institution::paginate(10);
        return view('intellisas.institutions',$data);
    }
    public function create(){
        return view('intellisas.create');
    }


    public function store(Request $request){
        $this->validate($request, [
           
            'name'=>'required',
           
            'username'=>'required|unique:institutions,username',
          
       ]);
       
        $institution = new Institution();
        $institution->name = $request->name;
        $institution->type = $request->type;
        $institution->username = $request->username;
        $institution->phone = $request->phone;
        $institution->email = $request->institution_email;
        $institution->alternate_phone = $request->alternate_phone;
        $institution->address = $request->address;
        $institution->state = $request->state;
        $institution->service_fee = $request->service_fee;
        $institution->applicant_fee = $request->applicant_fee;
        $institution->website = $request->website;
        $institution->heading = $request->heading;
      
    
       
        if ($request->file('logo') != null) {

            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/'.$request->username, $filename);
            $institution->logo = $filename;
        }
     
        $institution->save();

        $id = DB::table('institutions')->latest('id')->first();

        $user = new User();
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->user_email;
        $user->institution_id = $id->id;
        $user->usertype = "admin";
        $user->password = Hash::make($request->password);
        $user->save();

        Toastr::success('Institution Created sucessfully', 'success');
        return redirect()->route('institutions.index');
    }

    public function edit($id){
        $data['institution'] = Institution::find($id);
        return view('intellisas.edit',$data);
    }

    public function update(Request $request, $id){
        // dd($request->all());
        $this->validate($request, [
           
            'name'=>'required',
           
            'username'=>'required',
          
       ]);
       
        $institution = Institution::find($id);
        $institution->name = $request->name;
        $institution->type = $request->type;
        $institution->username = $request->username;
        $institution->phone = $request->phone;
        $institution->email = $request->institution_email;
        $institution->alternate_phone = $request->alternate_phone;
        $institution->address = $request->address;
        $institution->state = $request->state;
        $institution->service_fee = $request->service_fee;
        $institution->applicant_fee = $request->applicant_fee;
        $institution->website = $request->website;
        $institution->heading = $request->heading;
      
    
       
        if ($request->file('logo') != null) {

            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/'.$request->username, $filename);
            $institution->logo = $filename;
        }
     
        $institution->update();

        Toastr::success('Institution Updated sucessfully', 'success');
        return redirect()->route('institutions.index');
    }
}
