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

    // =========================================================================

    private function defineFunctionString($class, $functionName, $content = '')
    {
        return <<<EOF
    public function $functionName() {
        $content
    }
EOF;
    }

}
