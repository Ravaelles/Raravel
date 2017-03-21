<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Classes\FileHandler;

trait AddsFunctions
{

    public function addFunctions(Request $request)
    {
        $project = $this->getProjectFromUrl();

        // === Post ================================================================

        if ($request->isMethod('post')) {
            $className = $request->get('name');
            $path = $project->getPath() . "app/Classes/$className.php";
            $nameHuman = str_replace($project->getPath(), "", $path);

            FileHandler::createFile($path)->useTemplate('class', $request);

            flash("Added function $nameHuman", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        return view('actions.add-function')->with(compact('project'));
    }

}
