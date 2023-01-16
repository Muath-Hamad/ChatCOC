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
        // dd($request->all());
        $userinput = "";
        $chatbot_response = "";
        $user_id = null;
        if(Auth::check()){ // check if user is logged in
            $user = Auth::user();
            $user_id = $user['id']; // store logged in user id
        }

        if($request->ajax()){

          $userinput= $request->newdata;

         //return response($userinput);
         //$data_to_JSON = array("user_request" => $userinput); // pput input into an array
         // $JSON_to_python = json_encode($data_to_JSON); // encode array to JSON
          $script_path = app_path() . '\python\\' . 'chatbot.py'; // set up chatbot script path



          try{
            $userinput = mb_convert_encoding($userinput , "UTF-8");
            $process = new Process(['C:\Python310\python.exe' , $script_path ,$userinput]); // prepare process
            $process->run(); // excute proccess
            throw new ProcessFailedException($process);

          }catch(Exception $e){
            $error_msg = $e->getMessage();
            return response($error_msg);
          }
          if($process->isSuccessful()){
            $chatbot_response = $process->getOutput();
            $chatbot_response = mb_convert_encoding($chatbot_response , "UTF-8");
            return response($chatbot_response);

          }




        }


        // // Request Logging ---
        // if($userinput != ""){ // verify that user input is not empty

        // $user_decInput=json_decode($userinput); // decode json input to be stored as a string

        // if($chatbot_response == ""){ // for now this will allow chatbot to response with Nothing -- if a static error message is to be returned this where it should be edited
        //     $chatbot_decResponse = $chatbot_response;
        // }else{
        //     $chatbot_decResponse = json_decode($chatbot_response); // decode json response to be stored as a string
        // }
        // $reqlog = new chatRequest();
        // $reqlog -> user_id = $user_id;
        // $reqlog -> ur_content = $user_decInput;
        // $reqlog -> cr_content = $chatbot_decResponse;
        // $reqlog -> is_successful = false;

        // }



    }

}
