<?php

namespace App\Helpers;

class ConfigAppHelper
{

    public static function addServiceProvider($providerString)
    {
        $providerString = self::formatString($providerString);
        self::modifyAppPhpFile("'providers' => [", $providerString);
    }

    public static function addAlias($aliasString)
    {
        $aliasString = self::formatString($aliasString);
        self::modifyAppPhpFile("'aliases' => [", $aliasString);
    }

    // =========================================================================

    private static function formatString($string)
    {
        $string = "     $string";
        if (ends_with($string, ",")) {
            $string = substr($string, -1);
        }
        if (!ends_with($string, "::class")) {
            $string .= "::class";
        }
        $string .= ",";
        $string .= "\r\n";

        return $string;
    }

    private static function modifyAppPhpFile($offsetString, $insertString)
    {
        $path = base_path('config/app.php');
        $content = file_get_contents($path);

        if (str_contains($content, $insertString)) {
            return;
        }

        $index = strpos($content, "]", strpos($content, $offsetString));

        $content = substr($content, 0, $index - 1)
            . $insertString
            . substr($content, $index);

        file_put_contents($path, $content);
    }

}
