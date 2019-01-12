<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Classes\FileHandler;

trait AddsComplex
{
    /**
     * View + Function + Route
     */
    public function addEntireView(Request $request)
    {
        $project = $this->getProjectFromUrl();

        // === Post ================================================================

        if ($request->isMethod('post')) {
            $class = $request->get('class');
            session(['last-class' => $class]);

            $functionName = $request->get('name');
            $classNameHuman = $this->getClassHumanName($class);
            $viewParent = $this->defineClassNameKebabCase($classNameHuman);
            $viewName = $request->get('view-name');
//            dump($class);
//            dump($classNameHuman);
//            dump($viewParent);
//            dump($viewName);
//            die;

            $functionContent = "return view('$viewParent." . str_replace(".blade.php", "", $viewName) . "');";

            $this->insertView($viewParent, $viewName);
            $this->insertRoute($class, $functionName, $viewName);
            $this->insertFunction($class, $functionName, $functionContent);

            flash("Added route and function and view $classNameHuman.$viewName", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        $classes = $this->getClasses(true);

        return view('actions.add-entire-view')->with(compact('project', 'classes'));
    }

    /**
     * Function + Route
     */
    public function addRouteAndFunction(Request $request)
    {
        $project = $this->getProjectFromUrl();

        // === Post ================================================================

        if ($request->isMethod('post')) {
            $class = $request->get('class');
            session(['last-class' => $class]);

            $classNameHuman = $this->getClassHumanName($class);
            $functionName = $request->get('name');
            $functionContent = "";

            $this->insertRoute($class, $functionName);
            $this->insertFunction($class, $functionName, $functionContent);

            flash("Added route to routes, function to $classNameHuman", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        $classes = $this->getClasses(true);

        return view('actions.add-function')->with(compact('project', 'classes'));
    }

    /**
     * POST Function + Route
     */
    public function addPostFunction(Request $request)
    {
        $project = $this->getProjectFromUrl();

        // === Post ================================================================

        if ($request->isMethod('post')) {
            $class = $request->get('class');
            session(['last-class' => $class]);

            $classNameHuman = $this->getClassHumanName($class);
            $functionName = $request->get('name');
            $functionContent = "";

            $this->insertRoute($class, $functionName, null, 'post');
            $this->insertPostFunction($class, $functionName, $functionContent);

            flash("Added route to routes, function to $classNameHuman", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        $classes = $this->getClasses(true);

        return view('actions.add-post-function')->with(compact('project', 'classes'));
    }
}
