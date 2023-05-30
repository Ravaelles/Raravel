<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Classes\FileHandler;
use Illuminate\Support\Str;

trait AddsViews
{

    public function addPartial($parentName, $viewName, $request = null)
    {
        $project = $this->getProjectFromUrl();

        if (!Str::endsWith($viewName, ".blade.php")) {
            $viewName .= ".blade.php";
        }

        $parentName = Str::kebab($parentName);

        $path = $project->getPath() . "resources/views/$parentName/$viewName";
//        $path = "$viewName.php";
//        $path = $viewName;
//        dump($path);
//        die;

        if (!file_exists($path)) {
            FileHandler::createFile($path)->useTemplate('view', $request);
        }
    }

//    public function addView(Request $request)
//    {
//        $project = $this->getProjectFromUrl();
//
//        // === Post ================================================================
//
//        if ($request->isMethod('post')) {
//            $className = $request->get('class');
//            session(['last-class' => $class]);
//
//            $this->insertView($viewName);
//
//            flash("Added view $pathHuman", 'success');
//            return redirect()->route('project.show', $project->getName());
//        }
//
//        // =========================================================================
//
//        return view('actions.add-controller')->with(compact('project'));
//    }

    public function insertView($parentName, $viewName, $request = null)
    {
        $project = $this->getProjectFromUrl();

        if (!Str::endsWith($viewName, ".blade.php")) {
            $viewName .= ".blade.php";
        }

        $parentName = Str::kebab($parentName);

        $path = $project->getPath() . "resources/views/$parentName/$viewName";
//        $path = "$viewName.php";
//        $path = $viewName;

//        dump($path);
//        die;

        if (!file_exists($path)) {
            FileHandler::createFile($path)->useTemplate('view', $request);
        }
    }

}
