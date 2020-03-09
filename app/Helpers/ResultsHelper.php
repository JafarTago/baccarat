<?php
namespace App\Helpers;

class ResultsHelper
{
    public static function convertResult($result)
    {
        if (is_null($result)) {
            return null;
        }

        $explodeSecond = explode(".", $result);

        if ($explodeSecond[0] >= 60) {
            $result = gmdate("i分s秒", $explodeSecond[0]);
        } else {
            $result = gmdate("s秒", $explodeSecond[0]);
        }

        if (count($explodeSecond) == 2) {
            $result .= $explodeSecond[1];
        }

        return $result;
    }
}