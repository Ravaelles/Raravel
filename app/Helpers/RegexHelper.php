<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class RegexHelper
{

    public static function replace($regex, $replacement, $string)
    {
        if (!Str::startsWith($regex, "/")) {
            $pattern = '/' . $regex . '/i';
        } else {
            $pattern = $regex;
        }
        $result = preg_replace($pattern, $replacement, $string);
        echo "<pre>" . $result . "</pre>";
        exit;
    }

}
