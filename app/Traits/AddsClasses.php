<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Classes\FileHandler;

trait AddsClasses
{

    public function addClass(Request $request)
    {
        $project = $this->getProjectFromUrl();

        // === Post ================================================================

        if ($request->isMethod('post')) {
            $class = $request->get('class');
            session(['last-class' => $class]);

            $path = $project->getPath() . "app/Classes/$class.php";
            $pathHuman = str_replace($project->getPath(), "", $path);

            FileHandler::createFile($path)->useTemplate('class', $request);

            flash("Added class $pathHuman", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        return view('actions.add-class')->with(compact('project'));
    }

    public function addController(Request $request)
    {
        $project = $this->getProjectFromUrl();

        // === Post ================================================================

        if ($request->isMethod('post')) {
            $class = $request->get('class');
            session(['last-class' => $class]);

            $path = $project->getPath() . "app/Http/Controllers/$class.php";
            $pathHuman = str_replace($project->getPath(), "", $path);

            FileHandler::createFile($path)->useTemplate('controller', $request);

            flash("Added class $pathHuman", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        return view('actions.add-controller')->with(compact('project'));
    }

    public function addHelper(Request $request)
    {
        $project = $this->getProjectFromUrl();

        // === Post ================================================================

        if ($request->isMethod('post')) {
            $className = $request->get('class');
            session(['last-class' => $className]);

            $path = $project->getPath() . "app/Helpers/$className.php";
            $pathHuman = str_replace($project->getPath(), "", $path);

            FileHandler::createFile($path)->useTemplate('helper', $request);

            flash("Added helper $pathHuman", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        return view('actions.add-helper')->with(compact('project'));
    }

    public function addModel(Request $request)
    {
        $project = $this->getProjectFromUrl();

        // === Post ================================================================

        if ($request->isMethod('post')) {
            $className = $request->get('class');
            session(['last-class' => $className]);

            $path = $project->getPath() . "app/$className.php";
            $pathHuman = str_replace($project->getPath(), "", $path);

            FileHandler::createFile($path)->useTemplate('model', $request);

            flash("Added $pathHuman", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        return view('actions.add-model')->with(compact('project'));
    }

    // === Static files ===========================================================

    public function addEloquent(Request $request)
    {
        $project = $this->getProjectFromUrl();
        $path = $project->getPath() . "app/Eloquent.php";

        FileHandler::createFile($path)->useTemplate('eloquent', $request);

        flash("Added $path", 'success');
        return redirect()->route('project.show', $project->getName());
    }

    // === Auxiliary ==============================================================

    public function getClassHumanName($class)
    {
        return \App\Helpers\StringHelper::str_remove_from_both_sides("/", $class, ".");
    }

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

    public function defineClassNameLowercase($className)
    {
        return str_replace("controller", "", strtolower($className));
    }

    public function defineClassNameKebabCase($className)
    {
        return kebab_case(str_ireplace("controller", "", $className));
    }

    public function defineFunctionNameKebabCase($functionName)
    {
        return kebab_case($functionName);
    }

}
