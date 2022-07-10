<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Institution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LevelsController extends Controller
{
    public function index()
    {
        $data['allData'] = Level::where('institution_id',Auth::user()->institution_id)->paginate(5);
        return view('settings.levels.index', $data);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:191',
            'order'=>'required|max:191',
        ]);
       
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{

            $data = new Level();
            $data->name = $request->name;
            $data->order = $request->order;
            $data->institution_id = Auth::user()->institution_id;
            $data->save();

            return response()->json([
                'status'=>200,
                'message'=>'Level Added Successfully'
            ]);

        }
    }

 

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'update_name'=>'required|max:191',
            'update_order'=>'required|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{

            $form_data = array(
                'name' => $request->update_name,
                'order' => $request->update_order,
            );
            Level::whereId($request->update_id)->update($form_data);
    
            return response()->json([
                'status'=>200,
                'message'=>'Level Updated Succesfully'
            ]);

        }
       
    }

    public function delete(Request $request)
    {
        $data = Level::findOrFail($request->delete_id);
        if( $data->delete()){
            return response()->json([
                'status'=>200,
                'message'=>'Level Deleted Succesfully'
            ]);
        }
    }
}
