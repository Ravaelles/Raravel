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
            $class = $request->get('class');
            session(['last-class' => $class]);

            $classNameHuman = $this->getClassHumanName($class);
            $functionName = $request->get('name');

            $routesFile = $this->getRoutesFile();

            $functionString = $this->defineFunctionString($class, $functionName);
            $routeString = $this->defineRouteString($classNameHuman, $functionName);

            FileHandler::insertToTheEndOfClass($class, $functionString);
            FileHandler::appendToFile($routesFile, $routeString);

            flash("Added route to routes, function to $classNameHuman", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        $classes = $this->getClasses(true);

        return view('actions.add-function')->with(compact('project', 'classes'));
    }

    // =========================================================================

    private function getClasses($onlyControllers = false)
    {
        $classes = [];

        if ($onlyControllers) {
            $lookInDirs = [
                'app/Http/Controllers/' => 'Controller',
            ];
        } else {
            $lookInDirs = [
                'app/' => 'Model',
                'app/Http/Controllers/' => 'Controller',
                'app/Helpers/' => 'Helper',
                'app/Classes/' => 'Class'
            ];
        }

        foreach ($lookInDirs as $dir => $humanDirName) {
            $dirPath = $this->getProjectFromUrl()->getPath() . $dir . "*.php";
//            dump(glob($dirPath));
            foreach (glob($dirPath) as $path) {
                $filename = \App\Helpers\PathHelper::getFilenameByPath($path);
                $classes[$humanDirName][$path] = $filename;
//                $classes[$path] = $humanDirName . "/" . $filename;
            }
        }

//        echo "<br />END";
//        dd($classes);

        return $classes;
    }

    // =========================================================================

    private function defineFunctionString($class, $functionName)
    {
        return <<<EOF
    public function $functionName() {
        
    }
EOF;
    }

}
