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

            $path = app_path("$className.php");
            FileHandler::createFile($path);

            return redirect()->route('project.show', $project['name']);
        }

        // =========================================================================

        return view('actions.add-model')->with(compact('project'));
    }

}
