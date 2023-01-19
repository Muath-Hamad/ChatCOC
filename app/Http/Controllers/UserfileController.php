<?php

namespace App\Http\Controllers;

use App\Models\userfile;
use Exception;
use Illuminate\Support\Facades\Storage;
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

            $filename = Auth::id().'_'. time();
            $extension = $request->file('userfile')->getClientOriginalExtension();
            $namewithext = $filename . '.'.$extension;
            $request->file('userfile')->storeAs(
                'unprocessed_userfiles',
                $namewithext,
                'public'
            );
        }





        $script_path = app_path() . '\python\\' . '\makeFile\\'.'ReadingStudentGPA.py'; // set up ReadingStudentGPA script path

        try{

        $process = new Process(['C:\Python38\python.exe' , $script_path ,$filename]);
        $process->run();

        throw new ProcessFailedException($process);
        }catch(Exception $e){
        $error_msg = $e->getMessage();
        echo 'failed';
        dd($error_msg);
        }
        if($process->isSuccessful()){
           echo 'procces successful';


         $curruserfile->user_id = $user['id'];
         $curruserfile->path = $namewithext; // save the file name with extension
         $curruserfile->is_processed = true;
         $curruserfile->save();

        }else{
            echo 'failed';
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
        $fileid = Auth::user()->userfile->id; // find the user's user id
        $instance = userfile::find($fileid); // find the user file instance
        $file_name = $instance -> path; // save file name to delete it from storage
        $instance -> delete();

        // delete the file from storage
        $file_name = 'processed_userfiles/'.$file_name;
        try {
            Storage::delete($file_name);
            return redirect()->route('profile')->with('success', 'File deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin')->with('failed', 'File deletion failed !');
        }

    }

}
