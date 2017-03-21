<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Classes\FileHandler;

trait AddsFunctions
{

    public function addFunction(Request $request)
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

        $classes = $this->getClasses();

        return view('actions.add-function')->with(compact('project', 'classes'));
    }

    // =========================================================================

    private function getClasses()
    {
        $classes = [];

        $lookInDirs = ['app/', 'app/Http/Controllers', 'app/Helpers/', 'app/Classes/'];

        foreach ($lookInDirs as $dir) {
            $dirPath = base_path($dir . "*.php");
            dump(glob($dirPath));
            foreach (glob($dirPath) as $file) {
            }
        }

        echo "<br />END";
        dd($classes);

        return $classes;
    }

}
