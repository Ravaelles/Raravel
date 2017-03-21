<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Classes\FileHandler;

trait AddsClasses
{

    public function addModel(Request $request)
    {
        $project = $this->getProjectFromUrl();

        // === Post ================================================================

        if ($request->isMethod('post')) {
            $className = $request->get('class');
            $path = $project->getPath() . "app/$className.php";

            FileHandler::createFile($path)->useTemplate('model', $request);

            flash("Added $path", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        return view('actions.add-model')->with(compact('project'));
    }

    public function addEloquent(Request $request)
    {
        $project = $this->getProjectFromUrl();
        $path = $project->getPath() . "app/Eloquent.php";

        FileHandler::createFile($path)->useTemplate('eloquent', $request);

        flash("Added $path", 'success');
        return redirect()->route('project.show', $project->getName());
    }

}
