<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SessionController extends Controller
{
    public function index()
    {
        $data['allData'] = Session::where('institution_id',Auth::user()->institution_id)->paginate(5);
        return view('settings.sessions.index', $data);
    }

    public function paginate(Request $request)
    {
        $institution_id = Auth::user()->institution_id;
        $data['allData'] = Session::where('institution_id', $institution_id)->paginate(5);       
        return view('settings.sessions.table', $data)->render();
    }
    public function search(Request $request)
    {
    
        $institution_id = Auth::user()->institution_id;
        $data['allData'] = Session::where('institution_id', $institution_id)->where('name','like','%'.$request['query'].'%')->paginate(5);
        
        if( $data['allData']->count() )
        {
            return view('settings.sessions.table', $data)->render();
        }else
        {
            return response()->json([
                'status' => 404,
            ]);
        }
       
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:191',
        ]);
       
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{

            $data = new Session();
            $data->name = $request->name;
            $data->institution_id = Auth::user()->institution_id;
            $data->save();

            return response()->json([
                'status'=>200,
                'message'=>'Session Added Successfully'
            ]);

        }
    }

 

    public function update(Request $request)
    {
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
            Session::whereId($request->update_id)->update($form_data);
    
            return response()->json([
                'status'=>200,
                'message'=>'Session Updated Succesfully'
            ]);

        }
       
    }

    public function delete(Request $request)
    {
        $data = Session::findOrFail($request->delete_id);
        if( $data->delete()){
            return response()->json([
                'status'=>200,
                'message'=>'Session Deleted Succesfully'
            ]);
        }
    }
}
