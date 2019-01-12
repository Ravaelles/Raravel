<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Classes\FileHandler;

trait AddsFunctions
{
    public function insertFunction($className, $functionName, $functionContent = '')
    {
        $functionString = $this->defineFunctionString($className, $functionName, $functionContent);
        FileHandler::insertToTheEndOfClass($className, $functionString);
    }

    public function insertPostFunction($className, $functionName, $functionContent = '')
    {
        $functionString = $this->definePostFunctionString($className, $functionName, $functionContent);
        FileHandler::insertToTheEndOfClass($className, $functionString);
    }

    // =========================================================================

    private function defineFunctionString($class, $functionName, $content = '')
    {
        return <<<EOF
    public function $functionName()
    {
        $content
    }
EOF;
    }

    private function definePostFunctionString($class, $functionName, $content = '')
    {
        $requestString = 'Request $request';

        return <<<EOF
    public function $functionName($requestString) 
    {
        $content
    }
EOF;
    }
}
