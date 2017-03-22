<?php

namespace App\Helpers;

class DebugHelper
{

    public static function getGreenSection($text)
    {
        return "<div style='color:#2a2'>############################################################</div>"
            . "<div style='color:#2a2'>### $text</div>"
            . "<div style='color:#2a2'>############################################################</div><br />";
    }

    public static function getGreenLine($text)
    {
        return "<div style='color:#2a2'>$text</div>";
    }

}
