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
        dd ('test');
    }

    public function store(Request $request)
    {

        $request->validate([
            'adminfile' => ['required','mimes:pdf','max:10000']
        ]);
        $user = Auth::user();


        $curradminf = new adminfile();

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
            //return view('Admin.adminpage')->with('failed', 'System failed to process uploaded file !');
            dd($error_msg);
            }

        if($process->isSuccessful()){



            $curradminf->user_id = $user['id'];
            $curradminf->path = $namewithext; // save the f name with extension
            $curradminf->is_processed = true;
            $curradminf->is_excel = false;
            $curradminf->is_schedule = true;
            $curradminf->save();
            return redirect()->route('admin')->with('success', 'System processed uploaded file successfuly !');
            }else{
                 return view('Admin.adminpage')->with('failed', 'System failed to process uploaded file !');
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

    public function destroy($f)
    {

        $instance = adminfile::find($f);
        $f_name = $instance -> path;

        $instance ->forceDelete();
        return redirect()->route('admin')->with('success', 'file deleted successfully');
        // delete the f from storage
        $f_name = 'processed_adminfs/'.$f_name;
        try {
             Storage::delete($f_name);
             return redirect()->route('admin')->with('success', 'f deleted successfully');

        } catch (\Exception $e) {

            return redirect()->route('admin')->with('failed', 'f deletion failed !');
        }


    }
}
