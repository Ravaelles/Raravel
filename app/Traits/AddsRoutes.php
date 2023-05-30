<?php

namespace App\Traits;

use App\Helpers\StringHelper;
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

    public function insertRoute($class, $functionName, $viewName = null, $method = 'get')
    {
        $routesFile = $this->getRoutesFile();
        $routeString = $this->defineRouteString($class, $functionName, $viewName, $method);

//        dump($routeString);
//        die;

        FileHandler::appendToFile($routesFile, $routeString);
    }

    // =========================================================================

    public function getRoutesFile()
    {
        return $this->getProjectFromUrl()->getPath() . "routes/web.php";
    }

    public function defineRouteString($className, $functionName, $viewName, $method)
    {
//        $classNameHuman = $this->getClassHumanName($className);
        $classNameLowercase = $this->defineClassNameKebabCase($this->getClassHumanName($className));
        $functionNameKebabCase = $this->defineFunctionNameKebabCase($functionName);

        if ($viewName != null) {
            $routeName = $classNameLowercase . "." . str_replace(".blade.php", "", $viewName);
        } else {
            $routeName = $classNameLowercase . "." . $functionNameKebabCase;
        }

        $controllerPrefix = '';
        if (str_contains($className, 'app/Modules')) {
            $controllerPrefix = '\App\\' . StringHelper::str_remove_left_from('/app/', $className);
            $controllerPrefix = StringHelper::str_remove_right_from('Controllers/', $controllerPrefix)
                . 'Controllers/';
            $controllerPrefix = str_replace('/', '\\', $controllerPrefix);
        }

        $routeFunction = $controllerPrefix . $this->getClassHumanName($className) . "@" . $functionName;
        $routeName = ($routeName ?: "$classNameLowercase.$functionNameKebabCase");

//        dump('defineClassNameLowercase = ' . $classNameLowercase);
//        dump('$functionNameKebabCase = ' . $functionNameKebabCase);
//        dump('$routeName = ' . $routeName);

        $routeString = "Route::$method($classNameLowercase::class . '@$functionNameKebabCase', '$routeFunction')"
            . "->name('$routeName');";

//        $routeString = "Route::$method('$classNameLowercase/$functionNameKebabCase', '$routeFunction')"
//            . "->name('$routeName');";

        return $routeString;
    }

}
