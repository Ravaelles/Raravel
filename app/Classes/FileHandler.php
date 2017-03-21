<?php

namespace App\Classes;

use Illuminate\Http\Request;

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

    public function useTemplate($templateName, Request $request)
    {
        // Get raw file content from template
        $content = $this->getTemplateContent($templateName);

        // Modify and update content
        $content = $this->populateTemplateContent($content, $request);

        // Save content to file
        file_put_contents($this->path, $content);
        return $this;
    }

    // =========================================================================

    private function getTemplateContent($templateName)
    {
        return file_get_contents(resource_path("views/templates/$templateName.php"));
    }

    private function populateTemplateContent($content, Request $request)
    {
        $className = $request->get('class');

        // =========================================================================

        $content = str_replace("__MODEL_NAME__", $className, $content);

        return $content;
    }

}
