<?php

namespace App\Http\Controllers;

use App\Models\userfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
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



        // $request->validate([
        //     'userfile' => ['required','mimes:pdf','max:10000']
        // ]);
       // $user = Auth::user();

        //$curruserfile = new userfile();

        $filepath=false;
        // if($request->hasFile('userfile')){

        //     $filepath = $request->file('userfile')->storeAs(
        //         'unprocessed_userfiles',
        //         Auth::id().'_'. time() .'.'. $request->file('userfile')->getClientOriginalExtension(),
        //         'public'
        //     );
        // }

       // $data_to_JSON = array("path" => $filepath , "is_processed" => "false");
        $data_to_JSON = array("user_request" => "متى هو الموعد  المخصص لاختبار ماده math 115");

        $JSON_to_python = json_encode('math 115');

        $script_path = app_path() . '\python\\' . 'test.py';
        $command = "python3" . $script_path . $JSON_to_python;
        $process = new Process(['C:\Python310\python.exe' , $script_path ,'math 115']);
        $process->run();

        if(!$process->isSuccessful()){
            throw new ProcessFailedException($process);
        }
        if($process->isSuccessful()){
           // echo 'procces successful';

        }
        dd($process->getOutput());

        // if($filepath != false){
        // $curruserfile->user_id = $user['id'];
        // $curruserfile->path = $filepath;
        // $curruserfile->is_processed = false;
        // $curruserfile->save();
        // }


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
