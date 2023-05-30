<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class TestsController extends Controller
{
    public function run($params = null)
    {
//        $projectRoot = $this->getProjectRoot();

        $cmd = "cd /tectonic/awardforce && time vendor/bin/phpunit --filter ";
//        dd($cmd);
//        $cmd = "whoami";
//        $cmd = "pwd";
//        $cmd = "ls";
//
        // === Handle errors =======================================================

        $cmd = "$cmd 2>&1";

        // =========================================================================

        $output = shell_exec($cmd);
        $this->printConsoleOutput($output);
    }

    // =========================================================================

//    private function getProjectRoot()
//    {
////        $cmd = "cd .. && pwd";
//        $cmd = "a";
//        return trim(shell_exec($cmd));
//    }

    private function printConsoleOutput($output)
    {
        echo '<style>body { background-color: #333; font-weight: bold; color: #bb3; }</style>';

        if (! $output) {
            die('Invalid output');
        }

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
        exit;
    }
}
