<?php

namespace App;

use App\Helpers\StringHelper;

class Project
{

    private $path;
    private $name;

    // =========================================================================

    function __construct($path, $name)
    {
        $this->path = $path;
        $this->name = $name;
    }

    // =========================================================================

    public static function getProjectsGrouped()
    {
        $paths = explode(";", env('PROJECT_DIRS'));

        $groups = [];
        foreach ($paths as $path) {
            $dirName = StringHelper::str_remove_left_last_from("/", $path);
            $groups[] = [
                'path' => $path,
                'project' => $dirName
            ];
        }

        foreach ($groups as &$group) {
            $group['projects'] = self::getProjectsOfGroup($group);
        }
        unset($group);

        return $groups;
    }

    public static function getProjectByName($projectName)
    {
        $groups = self::getProjectsGrouped();
        foreach ($groups as $group) {
            foreach ($group['projects'] as $project) {
                if ($project->getName() === $projectName) {
                    return $project;
                }
            }
        }
        return null;
    }

    public static function getProjectPathByName($projectName)
    {
        $groups = self::getProjectsGrouped();
        foreach ($groups as $group) {
            foreach ($group['projects'] as $project) {
                if ($project->getName() === $projectName) {
                    return $project['path'];
                }
            }
        }
        return null;
    }

    // =========================================================================

    private static function getProjectsOfGroup($group)
    {
        $projects = [];

        $dirPath = $group['path'];
        $dirName = $group['project'];

        foreach (glob("$dirPath/*") as $child) {
            $name = StringHelper::str_remove_left_last_from("/", $child);

            if (!self::isProjectDir($child, $name)) {
                continue;
            }

//            $projects[] = [
//                'path' => $child,
//                'project' => $name,
//            ];
            $projects[] = new Project($child . "/", $name);
        }

        return $projects;
    }

    private static function isProjectDir($path, $dirName)
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

    // === Aux =================================================================

    public function getFavicon()
    {
        $favicon = $this->getPath() . "public/favicon.ico";
        if (!file_exists($favicon)) {
            $favicon = $this->getPath() . "public/favicon/";
            $files = glob($favicon . "*.ico");
            if (count($files)) {
                $favicon = $files[0];
            }
        }

        if (file_exists($favicon)) {
            $content = file_get_contents($favicon);
            if (strlen($content) > 0) {
                $iconBase64 = 'data:image/ico;base64,' . base64_encode($content);
                return $iconBase64;
            }
        }
        return null;
    }

    // =========================================================================

    function getPath()
    {
        return $this->path;
    }

    function getName()
    {
        return $this->name;
    }

}
