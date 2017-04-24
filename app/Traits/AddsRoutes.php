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

    public function insertRoute($className, $functionName)
    {
        $routesFile = $this->getRoutesFile();

        $routeString = $this->defineRouteString($className, $functionName);
        dump($className);
        dump($functionName);
        dd($routeString);

        FileHandler::appendToFile($routesFile, $routeString);
    }

    // =========================================================================

    public function getRoutesFile()
    {
        return $this->getProjectFromUrl()->getPath() . "routes/web.php";
    }

    public function defineRouteString($className, $functionName)
    {
        $classNameLowercase = $this->defineClassNameLowercase($className);
        $functionNameKebabCase = $this->defineFunctionNameKebabCase($functionName);
        $functionName = $routeString = "Route::get('$classNameLowercase/$functionNameKebabCase', "
            . "'$className@$functionName')"
            . "->name('$classNameLowercase.$functionNameKebabCase');";
        return $routeString;
    }

}
