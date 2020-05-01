<?php

namespace App\Helpers;

class StringHelper
{

    public static function removeDiacritical($string)
    {
        $normalizeChars = array(
            'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A',
            'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E',
            'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ñ' => 'N', 'Ń' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O',
            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B',
            'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
            'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i',
            'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ń' => 'n', 'ò' => 'o',
            'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u',
            'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f',
            'ă' => 'a', 'î' => 'i', 'â' => 'a', 'ș' => 's', 'ț' => 't', 'Ă' => 'A', 'Î' => 'I',
            'Â' => 'A', 'Ș' => 'S', 'Ț' => 'T', 'ą' => 'a', 'ę' => 'e', 'ń' => 'n', 'ź' => 'z',
            'ż' => 'z', 'ó' => 'o'
        );
        return strtr($string, $normalizeChars);
    }

    /**
     * Converts 1 to "1st", 2 to "2nd", 5 to "5th", 10 to "10th";
     */
    public static function addNumeralStringToNumber($number, $forceDisplayThisValue = null)
    {
        if ($forceDisplayThisValue === null) {
            $forceDisplayThisValue = $number;
        }

        if ($number == 1) {
            return $forceDisplayThisValue . "st";
        } elseif ($number == 2) {
            return $forceDisplayThisValue . "nd";
        } elseif ($number == 3) {
            return $forceDisplayThisValue . "rd";
        } elseif ($number == 4) {
            return $forceDisplayThisValue . "th";
        } else {
            if ($number > 19) {
                return addNumeralStringToNumber($number % 10, $forceDisplayThisValue);
            } else {
                return $forceDisplayThisValue . "th";
            }
        }
    }

    /**
     * Removes given char (or array of characters) from given string.
     */
    public static function str_remove($string, $charOrCharsToRemove)
    {
        return str_ireplace($charOrCharsToRemove, "", $string);
    }

    /**
     * Replaces spaces ' ', '%20' with given string.
     */
    public static function replaceSpacesWith($replacement, $subject)
    {
        return str_replace([' ', '%20'], $replacement, $subject);
    }

    /**
     * Removes everything on left from given substring e.g.<br />
     * str_remove_left_from("person: ", "This is person: Johny.txt") returns "Johny.txt"
     */
    public static function str_remove_left_from($substringOnLeft, $string)
    {
        return substr($string, strpos($string, $substringOnLeft) + strlen($substringOnLeft));
    }

    /**
     * Removes everything on left from last substring e.g.<br />
     * str_remove_left_last_from("hehe/foo/bar", "/") returns "bar"
     */
    public static function str_remove_left_last_from($substringOnLeft, $string)
    {
        return substr($string, strrpos($string, $substringOnLeft) + strlen($substringOnLeft));
    }

    /**
     * Removes everything on left and right from given substrings e.g.<br />
     * str_remove_from_both_sides("This person: ", "This person: Jordan.txt", ".txt") returns "Jordan"
     */
    public static function str_remove_from_both_sides($substringOnLeft, $string, $substringOnRight)
    {
        return self::str_remove_left_last_from($substringOnLeft, self::str_remove_right_from($substringOnRight, $string));
    }

    /**
     * Removes everything on right from given substring e.g.<br />
     * str_remove_right_from("This is Michael_Jordan.txt", ".txt") returns "This is Michael_Jordan"
     */
    public static function str_remove_right_from($substringOnRight, $string)
    {
        return substr($string, 0, strpos($string, $substringOnRight));
    }

    /**
     * Removes everything on right from given last substring e.g.<br />
     * str_remove_right_last_from("hehe/foo/bar", "/") returns "hehe/foo"
     */
    public static function str_remove_right_last_from($substringOnLeft, $string)
    {
        return substr($string, 0, strrpos($string, $substringOnLeft));
    }

    // === JSON ===========================================================

    public static function isValidJSON(...$args)
    {
        json_decode(...$args);
        return (json_last_error() === JSON_ERROR_NONE);
    }

}
