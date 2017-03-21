<?php

namespace App\Helpers;

use App\Helpers\StringHelper;

class PathHelper
{

    public static function getFilenameByPath($path)
    {
        $path = StringHelper::str_remove_left_last_from("/", $path);
        $path = StringHelper::str_remove_right_from(".", $path);
        return $path;
    }

}
