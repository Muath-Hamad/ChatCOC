<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class operatorpageController extends Controller
{
    //

    public function index(){


        // $admin_users = User::whereHas('roles', function($query) {
        //     $query->where('name', 'admin');
        // })->paginate(5);

        // $user = User::find(1);
        // $user->assignRole('admin');
        $admin_users = User::whereRoleIs( ['admin','operator'])->paginate(5);
        // dd($admin_users);
        return view('op.oppage' , compact('admin_users'))->with('i' , (request()->input('page',1)-1)*5);

        if(Auth::user()->hasRole('operator')){
            return view('operatorpage');

        }else{
            abort("403");
        }
    }
}
