<?php

namespace App\Http\Controllers;

use App\Models\userfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class UserfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        # code...
    }

    public function create()
    {
        # code...
    }

    public function store(Request $request)
    {

        //dd($request->allFiles());
        $request->validate([
            'userfile' => ['required','mimes:pdf','max:10000']
        ]);
        $user = Auth::user();

        $curruserfile = new userfile();

        $filepath=null;
        if($request->hasFile('userfile')){

            $filepath = $request->file('userfile')->storeAs(
                'unprocessed_userfiles',
                Auth::id().'_'. time() .'.'. $request->file('userfile')->getClientOriginalExtension(),
                'public'
            );
        }

        if($filepath !== null){
        $curruserfile->user_id = $user['id'];
        $curruserfile->path = $filepath;
        $curruserfile->is_processed = false;
        $curruserfile->save();

        }


        //dd($user);
       //dd($request->all());




       // $file = Input::file('path');

    }

    public function show()
    {
        # code...
    }

    public function edit()
    {
        # code...
    }

    public function update()
    {
        # code...
    }

    public function destroy()
    {
        # code...
    }

}
