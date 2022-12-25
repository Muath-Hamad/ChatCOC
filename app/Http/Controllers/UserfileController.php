<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class UserfileController extends Controller
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
            'userfile' => 'required|mimes:pdf'
        ]);
        dd($request->userfile);


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
