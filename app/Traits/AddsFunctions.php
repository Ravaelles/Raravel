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
            $className = $request->get('class');
            $functionName = $request->get('name');
            dump($className);
            dump($functionName);
            exit;
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

        $lookInDirs = [
            'app/' => 'Model',
            'app/Http/Controllers' => 'Controller',
            'app/Helpers/' => 'Helper',
            'app/Classes/' => 'Class'
        ];

        foreach ($lookInDirs as $dir => $humanDirName) {
            $dirPath = base_path($dir . "*.php");
//            dump(glob($dirPath));
            foreach (glob($dirPath) as $path) {
                $filename = \App\Helpers\PathHelper::getFilenameByPath($path);
//                $classes[$humanDirName][$path] = [$filename];
                $classes[$path] = $humanDirName . "/" . $filename;
            }
        }

//        echo "<br />END";
//        dd($classes);

        return $classes;
    }

}
