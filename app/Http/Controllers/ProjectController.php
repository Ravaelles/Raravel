<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Traits\AddsClasses;

class ProjectController extends Controller
{

    use AddsClasses;

    public function show($projectName)
    {
        $project = Project::getProjectByName($projectName);
        return view('project.show-project')->with(compact('project'));
    }

}
