<?php
namespace App\Helpers;

class Helper {

    /**
     * Returns string without X first chars and without Y last chars.
     * @param string $string initial string
     * @param string $skipXFirst how many first chars remove
     * @param string $skipYLast how many first chars remove
     * @return string
     */
    public static function substring($string, $skipXFirst = 0, $skipYLast = 0) {
        return substr($string, $skipXFirst, strlen($string) - 1 - $skipYLast);
    }

    /**
     * Removes given char (or array of characters) from given string.
     */
    public static function stringRemove($string, $charOrCharsToRemove) {
        return str_ireplace($charOrCharsToRemove, "", $string);
    }

    public static function questionMark($tooltip, $alignment = 'left', $placement = 'bottom') {
        $tooltip = "<div style='text-align: $alignment'>$tooltip</div>";

        $result = <<<EOF
        <i class="fa fa-lg fa-question question-mark" data-toggle="tooltip" 
            data-placement="$placement" title="$tooltip">
        </i>
EOF;
        return $result;
    }
    
    public static function timeStart($echoString = null) {
        if ($echoString) {
            echo $echoString . "<br />";
        }

        global $codeProfile_time;
        $codeProfile_time = microtime(true); // TIME START
    }

    public static function timeEnd($echoResult = true) {
        global $codeProfile_time;
        $time = microtime(true) - $codeProfile_time; // TIME END
        $time = sprintf("%.2f", $time);

        if ($echoResult) {
            echo "<br />## EXECUTION TIME: $time sec ##<br /><br />";
        }

        return $time;
    }

}
