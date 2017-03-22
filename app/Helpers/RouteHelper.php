<?php

namespace App\Helpers;

class RouteHelper
{

    public static function addRoute($routeString)
    {
        $path = base_path('routes/web.php');

        $content = file_get_contents($path);



        file_put_contents($path, $content);
    }

}
