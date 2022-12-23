<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminpageController extends Controller
{
    //
    

    public function index(){
        return view('adminpage'); // this is to make accesing this page easier during devlopment

        if(Auth::user()->hasRole('admin')){
            return view('adminpage');

        }else{
            abort("403");
        }
    }
}
