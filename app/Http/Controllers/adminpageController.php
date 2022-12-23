<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminpageController extends Controller
{
    //
    

    public function index(){
        return view('adminpage');

        if(Auth::user()->hasRole('admin')){
            return view('adminpage');

        }
    }
}
