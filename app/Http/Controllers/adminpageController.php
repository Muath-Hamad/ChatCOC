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
}
