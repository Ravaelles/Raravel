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

    public static function getRedSection($text)
    {
        return "<div style='color:#a22'>############################################################</div>"
            . "<div style='color:#a22'>### $text</div>"
            . "<div style='color:#a22'>############################################################</div><br />";
    }

    public static function getGreenLine($text)
    {
        return "<div style='color:#2a2'>$text</div>";
    }

    public static function getBlueLine($text)
    {
        return "<div style='color:#19a'>$text</div>";
    }

    public static function getRedLine($text)
    {
        return "<div style='color:#a22'>$text</div>";
    }

}
