<?php

namespace App\Helpers;

use App\Project;

class ConfigAppHelper
{

    public static function addServiceProvider($providerString, Project $project)
    {
        $providerString = self::formatString($providerString);
        self::modifyAppPhpFile($project->getPath(), "'providers' => [", $providerString);
    }

    public static function addAlias($aliasString, Project $project)
    {
        $aliasString = self::formatString($aliasString);
        self::modifyAppPhpFile($project->getPath(), "'aliases' => [", $aliasString);
    }

    // =========================================================================

    private static function formatString($string)
    {
        $string = "     $string";
        if (ends_with($string, ",")) {
            $string = substr($string, 0, strlen($string) - 1);
        }
        if (!ends_with($string, "::class")) {
            $string .= "::class";
        }
        $string .= ",";
        $string .= "\r\n";

        return $string;
    }

    private static function modifyAppPhpFile($directory, $offsetString, $insertString)
    {
//        $path = base_path('config/app.php');
        $path = $directory . 'config/app.php';
        $content = file_get_contents($path);

        if (str_contains($content, $insertString)) {
//            dump($content);
//            dump($insertString);
            echo DebugHelper::getBlueLine("String already there.<br /><br />");
            return;
        }

        $index = strpos($content, "]", strpos($content, $offsetString));

        $content = substr($content, 0, $index - 1)
            . $insertString
            . substr($content, $index);

//        var_dump($content);
//        exit;

        file_put_contents($path, $content);
    }

}
