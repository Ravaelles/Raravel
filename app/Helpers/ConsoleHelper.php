<?php

namespace App\Helpers;

use App\Models\Project;
use Illuminate\Support\Str;

class ConsoleHelper
{

    public static function executeCommandInProject($cmd, Project $project)
    {
        $projectDir = $project->getPath();
        $fullCommand = "cd $projectDir && " . $cmd . " 2>&1";
//        dd($fullCommand);
        $output = shell_exec($fullCommand);
        self::printConsoleOutput($output);

        return $output;
    }

    public static function executeCommand($cmd)
    {
        $output = shell_exec($cmd . " 2>&1");
        self::printConsoleOutput($output);
    }

    public static function printConsoleOutput($output)
    {
        $lines = explode("\n", htmlentities(trim($output)));

        // === Apply some extra styles ===========================================================

        $lastIndex = count($lines) - 1;
        for ($i = 0; $i <= $lastIndex; $i++) {
            $line = $lines[$i];

            if (str_contains($line, "failure:")) {
                $lines[$i] = "<span style='color:#C22;font-weight:bold;font-size:120%'>$line</span>";
            } else if ($i == $lastIndex && Str::startsWith($line, "OK (")) {
                $lines[$i] = "<span style='color:#292;font-weight:bold;font-size:120%'>$line</span>";
            }
        }

        // === Re-create string and print ========================================================

        $string = implode("\n", $lines);

        echo "<pre>" . $string . "</pre>";

        return $string;
    }

}
