<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Traits\AddsClasses;
use App\Traits\AddsFunctions;
use App\Traits\AddsRoutes;

class ProjectController extends Controller
{

    use AddsClasses,
        AddsFunctions,
        AddsRoutes;

    // =========================================================================

    public function show($projectName)
    {
        $project = Project::getProjectByName($projectName);
        return view('project.show-project')->with(compact('project'));
    }

}
