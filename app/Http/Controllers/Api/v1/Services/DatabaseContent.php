<?php

namespace App\Http\Controllers\Api\v1\Services;

use App\Models\Trip;
use DateTime;
use Illuminate\Support\Collection;

/**
 * Class DatabaseContent
 * @package App\Http\Controllers\Api\v1\Services
 */
class DatabaseContent
{
    /**
     * @param int|null $status
     * @return Collection
     */
    public function getListTravels(?int $status): Collection
    {
        $timeInterval = new DateTime('-1 year');
        if (!empty($status)) {
            $listTrips = Trip::whereNotNull(['country', 'start', 'end', 'person', 'subjects', 'country_code'])
                ->orderBy('end', 'desc')
                ->take($status)
                ->get();
        } else {
            $listTrips = Trip::whereNotNull(['country', 'start', 'end', 'person', 'subjects', 'country_code'])
                ->where('end', '>', $timeInterval)
                ->orderBy('end', 'desc')
                ->get();
        }

        return $listTrips;
    }
}
