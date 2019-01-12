<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Installer;
use App\Project;
use App\Traits\AddsClasses;
use App\Traits\AddsComplex;
use App\Traits\AddsFunctions;
use App\Traits\AddsRoutes;
use App\Traits\AddsTraits;
use App\Traits\AddsViews;
use App\Traits\InstallsPackages;

class ProjectController extends Controller
{
    use AddsClasses,
        AddsComplex,
        AddsFunctions,
        AddsRoutes,
        AddsTraits,
        AddsViews,
        InstallsPackages;

    // =========================================================================

    public function show($projectName)
    {
        $installers = Installer::getInstallers();
        $project = Project::getProjectByName($projectName);
        return view('project.show-project')->with(compact('project', 'installers'));
    }
}
