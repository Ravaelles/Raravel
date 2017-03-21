<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Classes\FileHandler;

trait AddsRoutes
{

    public function addRoute(Request $request)
    {
        $project = $this->getProjectFromUrl();

        // === Post ================================================================

        if ($request->isMethod('post')) {
            $className = $request->get('class');
            $path = $project->getPath() . "app/Classes/$className.php";
            $pathHuman = str_replace($project->getPath(), "", $path);

            FileHandler::createFile($path)->useTemplate('class', $request);

            flash("Added route $pathHuman", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        return view('actions.add-route')->with(compact('project'));
    }

}
