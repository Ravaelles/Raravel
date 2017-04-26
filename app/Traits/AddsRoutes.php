<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Classes\FileHandler;

trait AddsRoutes
{

    public function addRoute(Request $request)
    {
        $project = $this->getProjectFromUrl();

        die('inactive');

        // === Post ================================================================

        if ($request->isMethod('post')) {
            $className = $request->get('class');
            session(['last-class' => $class]);


            flash("Added route $pathHuman", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        return view('actions.add-route')->with(compact('project'));
    }

    public function insertRoute($class, $functionName, $viewName = null)
    {
        $routesFile = $this->getRoutesFile();
        $routeString = $this->defineRouteString($class, $functionName, $viewName);

//        dump($routeString);
//        die;

        FileHandler::appendToFile($routesFile, $routeString);
    }

    // =========================================================================

    public function getRoutesFile()
    {
        return $this->getProjectFromUrl()->getPath() . "routes/web.php";
    }

    public function defineRouteString($className, $functionName, $viewName)
    {
//        $classNameHuman = $this->getClassHumanName($className);
        $classNameLowercase = $this->defineClassNameLowercase($this->getClassHumanName($className));
        $functionNameKebabCase = $this->defineFunctionNameKebabCase($functionName);

        $routeName = $classNameLowercase . "." . str_replace(".blade.php", "", $viewName);

        $routeFunction = $this->getClassHumanName($className) . "@" . $functionNameKebabCase;
        $routeName = ($routeName ?: "$classNameLowercase.$functionNameKebabCase");

//        dump('defineClassNameLowercase = ' . $classNameLowercase);
//        dump('$functionNameKebabCase = ' . $functionNameKebabCase);
//        dump('$routeName = ' . $routeName);

        $routeString = "Route::get('$classNameLowercase/$functionNameKebabCase', '$routeFunction')"
            . "->name('$routeName');";

        return $routeString;
    }

}
