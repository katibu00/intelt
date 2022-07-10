<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'matric_number' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'matric_number' => $request->matric_number,
            'password' => Hash::make($request->password),
        ]);

        auth()->attempt($request->only('matric_number', 'password'));

        Alert::toast('Account Created sucessfully', 'success');
        return redirect()->back();
    }
}
