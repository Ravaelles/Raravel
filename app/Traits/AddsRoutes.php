<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Classes\FileHandler;

trait AddsRoutes
{

    public function addRoute(Request $request)
    {
        $project = $this->getProjectFromUrl();

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

    public function getRoutesFile()
    {
        return $this->getProjectFromUrl()->getPath() . "routes/web.php";
    }

    public function defineRouteString($className, $functionName)
    {
        $classNameLowercase = str_replace("controller", "", strtolower($className));
        $functionNameKebabCase = kebab_case($functionName);
        $functionName = $routeString = "Route::get('$classNameLowercase/$functionNameKebabCase', "
            . "'$className@$functionName')"
            . "->name('$classNameLowercase.$functionNameKebabCase');";
        return $routeString;
    }

}
