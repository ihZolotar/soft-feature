<?php

namespace App\Http\Controllers\Api\v1\Services;

/**
 * Class CountryHelper
 * @package App\Http\Controllers\Api\v1\Services
 */
class CountryHelper
{
    /**
     * Returns user country code, US by default
     * @return string
     */
    public static function getUserCountryCode(): string
    {
        /* $country = service for getting geolocation; */
        return $country ?? "US";
    }

    /**
     * @param $json
     * @param bool $assoc
     * @return mixed
     */
    public static function getJson($json, $assoc = true)
    {
        for ($i = 0; $i <= 31; ++$i) {
            $json = str_replace(chr($i), "", $json);
        }
        $json = str_replace(chr(127), "", $json);
        if (0 === strpos(bin2hex($json), 'efbbbf')) {
            $json = substr($json, 3);
        }
        return json_decode($json, $assoc);
    }
}
