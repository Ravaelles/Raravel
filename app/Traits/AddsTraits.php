<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Classes\FileHandler;

trait AddsTraits
{

    public function addTrait(Request $request)
    {
        $project = $this->getProjectFromUrl();

        // === Post ================================================================

        if ($request->isMethod('post')) {
            $className = $request->get('class');
            session(['last-class' => $className]);

            $functionName = $request->get('name');

            $path = $project->getPath() . "app/Traits/$className.php";
            $nameHuman = str_replace($project->getPath(), "", $path);

            FileHandler::createFile($path)->useTemplate('trait', $request);

            flash("Added trait $nameHuman", 'success');
            return redirect()->route('project.show', $project->getName());
        }

        // =========================================================================

        return view('actions.add-trait')->with(compact('project'));
    }

}
