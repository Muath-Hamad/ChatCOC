<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class chatbotrequestController extends Controller
{

    public function create(Request $request)
    {
        // dd($request->all());
        if($request->ajax()){

          $useriput= $request->newdata;


          $data_to_JSON = array("user_request" => $useriput); // pput input into an array

          $JSON_to_python = json_encode($useriput); // encode array to JSON

          $script_path = app_path() . '\python\\' . 'test.py'; // set up chatbot script path
          // $command = "python3" . $script_path . $JSON_to_python;
          $process = new Process(['python3' , $script_path ,$JSON_to_python]); // prepare process
          $process->run(); // excute proccess

          if(!$process->isSuccessful()){
              throw new ProcessFailedException($process);
          }


              return response($process->getOutput());


          //dd(json_decode($process->getOutput(),true));






        }


    }

}
