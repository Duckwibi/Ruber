<?php
namespace App\MyFunction;

use DateTime;

class Utilities{
    public static function dateCompare($str1, $str2): int{
        $date1 = new DateTime($str1);
        $date2 = new DateTime($str2);

        if($date1 == $date2)
            return 0;
        else
            return $date1 < $date2 ? -1 : 1;
    }
}