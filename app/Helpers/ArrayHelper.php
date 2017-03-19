<?php

namespace App\Helpers;

class ArrayHelper {

    public static function array_rand($array) {
        return $array[array_rand($array)];
    }

}
