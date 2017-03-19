<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function show($path)
    {
        $path = "/$path";
        dd($path);
    }

}
