<?php

namespace App\Http\Controllers;

use App\Models\adminfile;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AdminfileController extends Controller
{
    //
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
            'adminfile' => ['required','mimes:pdf','max:10000']
        ]);
        $user = Auth::user();


        $curradminfile = new adminfile();

        if($request->hasFile('adminfile')){

            $filename = Auth::id().'_'. time();
            $extension = $request->file('adminfile')->getClientOriginalExtension();
            $namewithext = $filename . '.'.$extension;
            $request->file('adminfile')->storeAs(
                'unprocessed_adminfiles',
                $namewithext,
                'public'
            );
        }

        $script_path = app_path() . '\python\\' . '\makeFile\\'.'readpdf.py'; // set up readpdf script path

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


            $curradminfile->user_id = $user['id'];
            $curradminfile->path = $namewithext; // save the file name with extension
            $curradminfile->is_processed = true;
            $curradminfile->is_excel = false;
            $curradminfile->is_schedule = true;
            $curradminfile->save();

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
    }
}
