<?php

namespace App\Services;

class DistanceService
{
    public static function getDistanceFromLatLonInKm($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $R = 6371; // Radius of the earth in km
        $dLat = self::deg2rad($latitude2 - $latitude1);  // deg2rad below
        $dLon = self::deg2rad($longitude2 - $longitude1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $R * $c; // Distance in km
        return $d;
    }


    public static function deg2rad($deg)
    {
        return $deg * (M_PI / 180);
    }
}
