<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\StringHelper;

class MainController extends Controller
{

    public function index()
    {
        $projectsGrouped = $this->getProjectsGrouped();
        return view('main.mainpage')->with(compact('projectsGrouped'));
    }

    // =========================================================================

    private function getProjectsGrouped()
    {
        $paths = explode(";", env('PROJECT_DIRS'));

        $groups = [];
        foreach ($paths as $path) {
            $dirName = StringHelper::str_remove_left_last_from("/", $path);
            $groups[] = [
                'path' => $path,
                'name' => $dirName
            ];
        }

        foreach ($groups as &$group) {
            $group['projects'] = $this->getProjectsOfGroup($group);
        }
        unset($group);

        return $groups;
    }

    private function getProjectsOfGroup($group)
    {
        $projects = [];

        $dirPath = $group['path'];
        $dirName = $group['name'];

        foreach (glob("$dirPath/*") as $child) {
            $name = StringHelper::str_remove_left_last_from("/", $child);

            if (!$this->isProjectDir($child, $name)) {
                continue;
            }

//            $path = "$dirPath/$child";
            $projects[] = [
                'path' => $child,
                'name' => $name,
            ];
        }

        return $projects;
    }

    private function isProjectDir($path, $dirName)
    {
        if (!is_dir($path)) {
            return false;
        }

        if (starts_with($dirName, "_")) {
            return false;
        }

        if (ends_with($dirName, "-old")) {
            return false;
        }

        $envPath = "$path/.env";
        if (!file_exists($envPath)) {
            return false;
        }

        return true;
    }

}
