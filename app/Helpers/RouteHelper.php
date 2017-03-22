<?php

namespace App\Helpers;

class RouteHelper
{

    public static function addRoute($routeString)
    {
        $path = base_path('routes/web.php');

        $content = file_get_contents($path);

        if (!str_contains($content, $routeString)) {
            $content .= "\r\n" . $routeString;
        }

        file_put_contents($path, $content);
    }

}
