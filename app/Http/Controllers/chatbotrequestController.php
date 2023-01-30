<?php

namespace App\Http\Controllers;

use App\Models\chatRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class chatbotrequestController extends Controller
{

    public function create(Request $request)
    {

        $userinput = ""; // intialize variables
        $chatbot_response = "";
        $user_id = null;
        $req_id = -1;
        $process_succesful = true; // assume that proccess is succesful

        if(Auth::check()){ // check if user is logged in
            $user = Auth::user();
            $user_id = $user['id']; // store logged in user id
        }

        if($request->ajax()){

          $userinput= $request->newdata;

          // Request Logging ---
             // verify that user input is not empty

            $reqlog = new chatRequest();
            $reqlog -> user_id = $user_id;
            $reqlog -> ur_content = $userinput;
            $reqlog -> cr_content = $chatbot_response;
            $reqlog -> is_successful = false;
            $reqlog -> save();

            $req_id = $reqlog->id; // assign the added instance id to $req_id

         //return response($userinput);
          $script_path = app_path() . '\python\\' . 'chatbot.py'; // set up chatbot script path

            $userinput = mb_convert_encoding($userinput , "UTF-8"); // encode $userinput to UTF-8

            if($req_id != -1){ // ensure that instance was saved to DB
                $process = new Process(['C:\Python39\python.exe' , $script_path ,$userinput , $req_id]); // prepare process
                $process->run(); // excute proccess

                if($process->getOutput()== ""){
                    $process_succesful =true;
                }else{
                    $process_succesful =false;
                    return response($process->getOutput());
                }
                 }

          if($process_succesful && $req_id != -1){ // ensure that process is succesful & and the instance was created for the request
            $result = chatRequest::find($req_id);
            $chatbot_response = $result->cr_content;
            //$chatbot_response = mb_convert_encoding($chatbot_response , "UTF-8");
            return response($chatbot_response);
          }
        }
    }
}
