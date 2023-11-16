<?php

namespace App\Traits;

trait Date
{
    public static function OriginalToDb($explode_sign,$data)
    {
        // 16-11-2023
        $explode = explode($explode_sign,$data);
        $date = $explode['2'].'-'.$explode['1'].'-'.$explode['0'];
        return $date;
    }
    public static function DbToOriginal($explode_sign,$data)
    {
        // 16-11-2023
        $explode = explode($explode_sign,$data);
        $date = $explode['2'].'-'.$explode['1'].'-'.$explode['0'];
        return $date;
    }
}
