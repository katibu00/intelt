<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin(){
        return view('admin');

    }
    public function intellisas(){
        return view('intellisas');
    }
    public function student(){
        return view('student');
    }
}
