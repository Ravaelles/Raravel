<?php

namespace App\Classes;

class FileHandler
{

    private $path;

    // =========================================================================

    function __construct($path)
    {
        $this->path = $path;
    }

    // =========================================================================

    public static function createFile($path)
    {
        $file = new FileHandler($path);
        if (!file_exists($path)) {
            file_put_contents($path, "");
        } else {
            abort(400, "File $path already exists");
//            flash("File $path already exists", 'danger');
        }
        return $file;
    }

}
