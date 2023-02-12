<?php

namespace App\Http\Controllers;
use App\Models\adminfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminpageController extends Controller
{
    //


    public function index(){
        $adminfiles = adminfile::latest()->paginate(5);
        return view('Admin\adminpage' , compact('adminfiles'))->with('i' , (request()->input('page',1)-1)*5); // this is to make accesing this page easier during devlopment

        if(Auth::user()->hasRole('admin')){
            return view('adminpage');

        }else{
            abort("403");
        }
    }
    public function update(Request $request){

        $start_date_1 = $request -> start_date_1; $end_date_1 = $request -> start_date_1;
        $start_date_2 = $request -> start_date_2;
        $start_date_3 = $request -> start_date_3;
        $start_date_4 = $request -> start_date_4;
        $start_date_5 = $request -> start_date_5;
        $start_date_6 = $request -> start_date_6;
        $start_date_7 = $request -> start_date_7;
        $start_date_8 = $request -> start_date_8;
        $start_date_9 = $request -> start_date_9;
        $start_date_10 = $request -> start_date_10;
        $start_date_11 = $request -> start_date_11;
        $start_date_12 = $request -> start_date_12;
        $start_date_13 = $request -> start_date_13;
        $start_date_14 = $request -> start_date_14;
        $start_date_15 = $request -> start_date_15;

        $end_date_1 = $request -> start_date_1;
        $end_date_1 = $request -> start_date_1;
        $end_date_1 = $request -> start_date_1;
        $end_date_1 = $request -> start_date_1;
        $end_date_1 = $request -> start_date_1;
        $end_date_1 = $request -> start_date_1;
        $end_date_1 = $request -> start_date_1;
        $end_date_1 = $request -> start_date_1;
        $end_date_1 = $request -> start_date_1;

        foreach ($request->all() as $inputName => $inputValue) {
            // Do something with the input
        }

        dd($start_date_1);


    }
}
