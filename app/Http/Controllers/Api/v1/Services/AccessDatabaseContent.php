<?php

namespace App\Http\Controllers\Api\v1\Services;

use App\Models\{
    CasesGroupVc,
    CountryInfo,
    OfficeCustomer,
    PageGroupVc,
    ProjectsMap,
    Trip
};
use DateTime;
use Exception;
use Waavi\Translation\Models\Translation;
use Illuminate\Support\Collection;

/**
 * Class AccessDatabaseContent
 * @package App\Http\Controllers\Api\v1\Services
 */
class AccessDatabaseContent
{
    /**
     * Get list travels
     *
     * @param int $status
     * @return array
     * @throws Exception
     */
    public function getListTravels(int $status = 0): array
    {
        $timeInterval = new DateTime('-1 year');

        if (!empty($status)) {
            $listTrips = Trip::orderBy('end', 'desc')
                ->take($status)
                ->get();
        } else {
            $listTrips = Trip::where('end', '>', $timeInterval)->orderBy('end', 'desc')->get();
        }

        $userCountryCode = CountryHelper::getUserCountryCode();
        $data = ['countries' => [], 'list' => [], 'active_country_code' => 'NONE'];
        $latLng = [53.9076843, 27.4497587];

        foreach ($listTrips as $item) {
            if (
                empty($item['country'])
                || empty($item['start'])
                || empty($item['end'])
                || empty($item['person'])
                || empty($item['subjects'])
                || empty($item['country_code'])
            ) {
                continue;
            }

            $info = [
                'country' => $item['country'],
                'date_from' => empty($item['start']) ? '' : $item['start'],
                'date_to' => $item['end'],
                'persons' => $item['person'],
                'description' => $item['subjects'],
                'country_code' => $item['country_code'],
                'lat' => $latLng[0],
                'lng' => $latLng[1],
                'about' => $item['about_trip'],
                'gps' => $item['coordinates'],
                'person_list' => $item['person_list'],
                'status' => $item['status'],
                'id' => $item['id']
            ];

            $data['countries'][$item['country_code']][] = $data['list'][] = $info;
            if ($userCountryCode === $item['country_code']) {
                $data['active_country_code'] = $item['country_code'];
            }
        }

        return $data;
    }

    /**
     * Get information about trip
     *
     * @param int $id
     * @return bool|array
     */
    public function getTrip(int $id)
    {
        if (!empty($id)) {
            $trip = Trip::findOrFail($id);
            $trip['video_links'] = explode(';', $trip['video_links']);
            $trip['photo_links'] = explode(';', $trip['photo_links']);
            if (empty(trim($trip['img_link']))) {
                $trip['img_link'] = Trip::DEFAULT_IMAGE_HEADER;
            }
            return $trip;
        }

        return false;
    }

    /**
     * @return ProjectsMap[]|Collection
     */
    public function getAllDataProjectsMap()
    {
        $allData = ProjectsMap::all()->keyBy('name');
        foreach ($allData as $value) {
            $allData[$value->name]->technology = explode(',', $value->technology);
        }

        return $allData;
    }

    /**
     * @return array
     */
    public function getCountryInfo(): array
    {
        $country = CountryInfo::all()->toArray();
        $reformedArray = [];
        foreach ($country as $item) {
            $item['coordinates'] = explode(',', $item['coordinates']);
            $reformedArray[] = $item;
        }

        return $reformedArray;
    }

    /**
     * @return array
     */
    public function getCountryGroupInfo(): array
    {
        $country = CountryInfo::whereIn('city', ['Canberra', 'New York', 'Chicago', 'Atlanta'])->get()->groupBy('country')->toArray();
        $reformedArray = [];
        foreach ($country as $key => $item) {
            $item = array_map(function ($object) {
                $object['coordinates'] = explode(',', $object['coordinates']);
                return $object;
            }, $item);
            $reformedArray[$key] = $item;
        }

        return $reformedArray;
    }

    /**
     * Get Translate by location
     *
     * @param string $locale
     * @return Collection
     */
    public static function getTranslateByLocale(string $locale = 'en'): Collection
    {
        return Translation::where('locale', $locale)->get(['item', 'text']);
    }

    /**
     * Get customer for office
     *
     * @param string $location
     * @return mixed
     */
    public function getOfficeCustomers(string $location = 'minsk')
    {
        return OfficeCustomer::where('office_location', $location)->orderBy('priority')->get();
    }

    /**
     * @param $routeName
     * @param CasesDatabaseContent $casesDatabaseContent
     * @return array|bool|string
     */
    public function getVisualConceptToPages($routeName, CasesDatabaseContent $casesDatabaseContent)
    {
        if (!empty($routeName)) {
            $group = PageGroupVc::where('route_name', $routeName)->orderBy('priority')->get()->toArray();

            return $casesDatabaseContent->vcDataGroup($group);
        }

        return false;
    }

    /**
     * @param int $id
     * @param $casesDatabaseContent
     * @return array|string
     */
    public function getVisualConceptById(int $id, $casesDatabaseContent)
    {
        $groups[] = CasesGroupVc::where('cases_id', $id)
            ->orderBy('priority')
            ->get()
            ->toArray();

        return $casesDatabaseContent->vcDataGroup($groups[0]);
    }
}
