<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chatbotrequestController extends Controller
{

    public function create(Request $request)
    {
        // dd($request->all());
        if($request->ajax()){

          $useriput= $request->newdata;
           return response($useriput);


        }
       return "test bader";

    }

}
