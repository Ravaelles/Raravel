<?php

namespace App\Classes;

use Illuminate\Http\Request;
use \App\Helpers\StringHelper;

class FileHandler
{
    private $path;

    // =========================================================================

    function __construct($path)
    {
        $this->path = $path;
    }

    // === Modify existing file ================================================

    public static function prependToFile($file, $content)
    {
        $fileContent = file_get_contents($file);
        if (!str_contains($fileContent, $content)) {
            file_put_contents($file, $content . "\n" . $fileContent);
        }
    }

    public static function appendToFile($file, $content)
    {
        $fileContent = file_get_contents($file);
        $hasDoubleNewLine = ends_with($fileContent, "\n\n");
        $hasSingleNewLine = ends_with($fileContent, "\n");
        if (!$hasDoubleNewLine) {
            $fileContent .= "\n";
        }
        if (!$hasSingleNewLine) {
            $fileContent .= "\n";
        }

        if (!str_contains($fileContent, $content)) {
            file_put_contents($file, $fileContent . $content);
        }
    }

    public static function insertToTheEndOfClass($file, $content)
    {
        $fileContent = file_get_contents($file);

        $lastBracketIndex = strrpos($fileContent, "}");
        $preContent = substr($fileContent, 0, $lastBracketIndex) . "\n";
        $postContent = "\n" . substr($fileContent, $lastBracketIndex);

        if (!str_contains($fileContent, $content)) {
            file_put_contents($file, $preContent . $content . $postContent);
        }
    }

    // === Create new file =====================================================

    public static function createFile($path)
    {
        $file = new FileHandler($path);
        if (!file_exists($path)) {
            $file->ensureDirExists($path);
            file_put_contents($path, "");
        } else {
            abort(400, "File $path already exists");
//            flash("File $path already exists", 'danger');
        }
        return $file;
    }

    public function ensureDirExists($path)
    {
        $dir = StringHelper::str_remove_right_last_from("/", $path);
        if (!file_exists($dir)) {
            mkdir($dir);
        }
    }

    public function useTemplate($templateName, $request)
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

    private function populateTemplateContent($content, Request $request = null)
    {
        $className = $request !== null ? $request->get('class') : '';

        // =========================================================================

        $content = str_replace("__CLASS_NAME__", $className, $content);

        // =========================================================================

        return $content;
    }
}
