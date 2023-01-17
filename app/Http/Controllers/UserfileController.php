<?php

namespace App\Http\Controllers;

use App\Models\userfile;
use Exception;
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



        $request->validate([
            'userfile' => ['required','mimes:pdf','max:10000']
        ]);
        $user = Auth::user();

        $curruserfile = new userfile();

        if($request->hasFile('userfile')){

            $filename = Auth::id().'_'. time() .'.'. $request->file('userfile')->getClientOriginalExtension();
            $request->file('userfile')->storeAs(
                'unprocessed_userfiles',
                 $filename,
                'public'
            );
        }





    $script_path = app_path() . '\python\\' . '\makeFile\\'.'ReadingStudentGPA.py'; // set up ReadingStudentGPA script path

    try{

        $process = new Process(['C:\Python310\python.exe' , $script_path ,$filename]);
        $process->run();

        throw new ProcessFailedException($process);
    }catch(Exception $e){
        $error_msg = $e->getMessage();
        dd($error_msg);
    }
        if($process->isSuccessful()){
           echo 'procces successful';


         $curruserfile->user_id = $user['id'];
         $curruserfile->path = $filename;
         $curruserfile->is_processed = true;
         $curruserfile->save();

        }


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
