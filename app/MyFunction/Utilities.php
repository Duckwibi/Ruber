<?php
namespace App\MyFunction;

use DateTime;

class Utilities{
    public static function dateCompare(string $str1, string $str2): int{
        $date1 = new DateTime($str1);
        $date2 = new DateTime($str2);

        if($date1 == $date2)
            return 0;
        else
            return $date1 < $date2 ? -1 : 1;
    }

    public static function getOtp(): string{
        $otp = "";
        for($i = 1; $i <= 6; $i++){
            $otp .= rand(0, 9);
        }
        return $otp;
    }

    public static function getRandomKey(int $max): string{
        $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $key = "";
        for($i = 1; $i <= $max; $i++){
            $key .= $str[rand(0, strlen($str) - 1)];
        }
        return $key;
    }

    public static function formatCurrency(float $num): string{
        return number_format($num, 0, ",", ".");
    }
}