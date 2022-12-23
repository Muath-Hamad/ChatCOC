<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class operatorpageController extends Controller
{
    //

    public function index(){
        return view('operatorpage'); // this is to make accesing this page easier during devlopment

        if(Auth::user()->hasRole('operator')){
            return view('operatorpage');

        }else{
            abort("403");
        }
    }
}
