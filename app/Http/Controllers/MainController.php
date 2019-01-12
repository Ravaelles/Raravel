<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class MainController extends Controller
{
    public function index()
    {
        $projectsGrouped = Project::getProjectsGrouped();
        return view('main.dashboard')->with(compact('projectsGrouped'));
    }

    // =========================================================================

    public function test()
    {
        return view('main.test');
    }
}
