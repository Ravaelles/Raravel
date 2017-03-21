<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Project;

class Controller extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected function getProjectFromUrl()
    {
        $projectName = \Illuminate\Support\Facades\Request::segment(2);
        return Project::getProjectByName($projectName);
    }

}
