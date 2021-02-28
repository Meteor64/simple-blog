<?php


namespace App\Utility;


use Hekmatinasser\Verta\Verta;

class Utility
{
    public static function jalaliDate($date): string
    {
        return verta($date)->format('Y/m/d');
    }

    public static function vertaDifference($date)
    {
        return Verta::instance($date)->formatDifference();
    }
}
