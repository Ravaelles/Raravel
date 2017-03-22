<?php

namespace App\Helpers;

class RegexHelper
{

    public static function replace($regex, $replacement, $string)
    {
        if (!starts_with($regex, "/")) {
            $pattern = '/' . $regex . '/i';
        } else {
            $pattern = $regex;
        }
        $result = preg_replace($pattern, $replacement, $string);
        echo "<pre>" . $result . "</pre>";
        exit;
    }

}
