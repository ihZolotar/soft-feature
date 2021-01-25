<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\v1\Services\{
    AccessDatabaseContent,
    CasesDatabaseContent,
    CountryHelper,
    DatabaseContent,
    ReviewsDatabaseContent
};
use App\Http\Controllers\Controller;
use App\Http\Resources\{
    CountryResource,
    CustomerPopupResource,
    CvResource,
    DesignerCaseDataResource,
    DesignerHeaderResource,
    ImportOfficeResource,
    NewDesignerCustomerResource,
    NewNonexistentCustomerResource,
    NonexistentCustomerDataResource,
    NonexistentCustomerResource,
    OfficeResource,
    ProjectMapResource,
    ReviewResource,
    TripResource,
    VacancyResource,
    VideoResource
};
use App\Models\{
    CaseInfo,
    Customer,
    DesignerCasesVc,
    NonexistentCustomer,
    PageCv,
    PageNonexistentCustomers,
    ProjectsMap,
    Video
};
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

/**
 * Class ApiController
 * @package App\Http\Controllers\Api\v1
 */
class ApiController extends Controller
{
    /**
     * @param $id
     * @param AccessDatabaseContent $tableContent
     * @param CasesDatabaseContent $casesContent
     * @return JsonResponse
     */
    public function getVcForDesignerPage(
        $id,
        AccessDatabaseContent $tableContent,
        CasesDatabaseContent $casesContent
    ): JsonResponse
    {
        $designerCard = DesignerCasesVc::whereId($id)
            ->get(['cases_id', 'title', 'country', 'country_code', 'rout_page_vc', 'nonexistent_customers_id'])
            ->toArray();
        $visualConcept = [];
        if (!empty($designerCard[0]['cases_id'])) {
            $visualConcept = $tableContent->getVisualConceptById($designerCard[0]['cases_id'], $casesContent);
            foreach ($designerCard as $key => $item) {
                $case = CaseInfo::findOrFail($item['cases_id']);
                $customer = Customer::where('link', 'like', '%' . $case->name)
                    ->first(['cooperation_time', 'domains'])
                    ->toArray();
            }
        } elseif (!empty($designerCard[0]['rout_page_vc'])) {
            $visualConcept = $tableContent->getVisualConceptToPages(
                $designerCard[0]['rout_page_vc'],
                $casesContent
            );
            foreach ($designerCard as $key => $item) {
                $customer = NonexistentCustomer::findOrFail(
                    $item['nonexistent_customers_id'],
                    ['cooperation_time', 'domains']
                )->toArray();
            }
        }

        return response()->json([
            'allInfo' => DesignerCaseDataResource::collection($visualConcept),
            'data' => [
                'title' => $designerCard[0]['title'] ?? null,
                'country' => $designerCard[0]['country'] ?? null,
                'cooperation_time' => $customer['cooperation_time'] ?? null,
                'domain' => $customer['domains'] ?? null,
                'country_code' => $designerCard[0]['country_code'] ?? null
            ]
        ]);
    }

    /**
     * @param $routeName
     * @return JsonResponse
     */
    public function getReviews($routeName): JsonResponse
    {
        $countryCode = CountryHelper::getUserCountryCode();
        $reviews = ($countryCode === 'US' && $routeName === 'index')
            ? ReviewsDatabaseContent::getReviewsForLocale($countryCode)
            : ReviewsDatabaseContent::getReview($routeName);

        return response()->json(ReviewResource::collection($reviews));
    }

    /**
     * @return JsonResponse
     */
    public function getOfficesInfo(): JsonResponse
    {
        $offices = OfficeInfoProvider::instance()->getOfficesForAboutUs();

        return response()->json(OfficeResource::collection($offices));
    }

    /**
     * @return JsonResponse
     */
    public function getDesignerPageImg(): JsonResponse
    {
        $designerCases = DesignerCasesVc::limit(9)->orderBy('general_priority')->get();
        $info = $designerCases[rand(0, 8)];
        if (!empty($info['cases_id']) && empty($info['nonexistent_customers_id'])) {
            $case = CaseInfo::findOrFail($info['cases_id']);
            $info['customer'] = Customer::where('link', 'like', '%' . $case->name)->firstOrFail();
        } elseif (!empty($info['nonexistent_customers_id'])) {
            $info['customer'] = NonexistentCustomer::findOrFail($info['nonexistent_customers_id']);
        } elseif (!empty($info['customer_id'])) {
            $info['customer'] = Customer::findOrFail($info['customer_id']);
        }

        return response()->json(new DesignerHeaderResource($info));
    }

    /**
     * @param $domain
     * @return JsonResponse
     */
    public function getCustomersDomain($domain): JsonResponse
    {
        $customers = Customer::where('domains_calculator', 'like', '%' . $domain . '%')->get();

        return response()->json(CustomerPopupResource::collection($customers));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getNonexistentCaseVC(int $id): JsonResponse
    {
        $nonexistentCustomers = NonexistentCustomer::findOrFail($id);
        $review = $nonexistentCustomers->review()
            ->get(['name', 'position', 'description', 'linkedin', 'photo', 'clutch_link'])
            ->toArray();
        $nonexistentCustomerData = $nonexistentCustomers->data()->get(['id', 'unit', 'name', 'value', 'icon']);
        $nonexistentCustomers->toArray();
        $nonexistentCustomers['data'] = $nonexistentCustomerData
            ->groupBy('unit')
            ->toArray();
        $nonexistentCustomers['review'] = $review[0] ?? null;

        return response()->json(new NonexistentCustomerDataResource($nonexistentCustomers));
    }

    /**
     * @param AccessDatabaseContent $tableContent
     * @return JsonResponse
     */
    public function getAllProjectMap(AccessDatabaseContent $tableContent): JsonResponse
    {
        $dataProjectsMap = ProjectsMap::all()->keyBy('name');
        foreach ($dataProjectsMap as &$item) {
            $specialists = $item->specialists()->get(['qa', 'ui_ux', 'devops', 'pm', 'ba', 'mobile', 'aws', 'support']);
            $team = $item->team()->get(['count', 'position'])->keyBy('position')->toArray();
            $team = array_map(function ($value) {
                return $value['count'];
            }, $team);
            $item['specialists'] = $specialists[0];
            $item['team'] = $team;
        }
        $countriesInfo = $tableContent->getCountryInfo();
        $countryGroupInfo = $tableContent->getCountryGroupInfo();

        return response()->json([
            'pm' => ProjectMapResource::collection($dataProjectsMap),
            'country' => CountryResource::collection($countriesInfo),
            'country_exception' => [
                'Australia' => CountryResource::collection($countryGroupInfo['Australia']),
                'United States of America' => CountryResource::collection($countryGroupInfo['United States of America']),
            ],
        ]);
    }

    /**
     * @param string $type
     * @return JsonResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getInfoOneC(string $type): JsonResponse
    {
        if ($type == 'office' && Storage::disk('publicPathData')->exists('data/offices-info.json')) {
            $json = CountryHelper::getJson(Storage::disk('publicPathData')->get('data/offices-info.json'));

            return response()->json(new ImportOfficeResource($json['infGeneral'][0]));
        } elseif ($type == 'vacancy' && Storage::disk('publicPathData')->exists('data/vacancies.json')) {
            $json = CountryHelper::getJson(Storage::disk('publicPathData')->get('data/vacancies.json'));

            return response()->json(VacancyResource::collection($json['Vacancies']));
        } else {
            return response()->json(null);
        }
    }

    /**
     * @param $routeName
     * @return JsonResponse
     */
    public function cvByPage($routeName): JsonResponse
    {
        $cvList = PageCv::wherePage($routeName)
            ->orderBy('priority')
            ->with('resume')
            ->get(['cv_data_id', 'priority'])
            ->pluck('resume')
            ->flatten();

        return response()->json(CvResource::collection($cvList));
    }

    /**
     * @return JsonResponse
     */
    public function getAllVideo(): JsonResponse
    {
        $allVideo = Video::all()->sortByDesc('date')->groupBy('group');

        return response()->json([
            'Meetups' => VideoResource::collection($allVideo['Meetups']),
            'Lectures' => VideoResource::collection($allVideo['Lectures']),
            'Entertainment' => VideoResource::collection($allVideo['Entertainment']),
        ]);
    }

    /**
     * @param int|null $count
     * @param DatabaseContent $databaseContent
     * @return JsonResponse
     */
    public function getTrip(DatabaseContent $databaseContent, int $count = null): JsonResponse
    {
        $trip = $databaseContent->getListTravels($count);

        return response()->json(TripResource::collection($trip));
    }

    /**
     * @param string $page
     * @return JsonResponse
     */
    public function getCustomerCard(string $page): JsonResponse
    {
        if ($page == 'designers') {
            $allDesignerCard = DesignerCasesVc::all()->sortBy('general_priority');
            foreach ($allDesignerCard as $key => $item) {
                if (!empty($item['cases_id']) && empty($item['nonexistent_customers_id'])) {
                    $case = CaseInfo::findOrFail($item['cases_id']);
                    $customer = Customer::where('link', 'like', '%' . $case->name)->first();
                    $allDesignerCard[$key]['customer'] = $customer;
                } elseif (!empty($item['nonexistent_customers_id'])) {
                    $allDesignerCard[$key]['customer'] = NonexistentCustomer::findOrFail($item['nonexistent_customers_id']);
                } elseif (!empty($item['customer_id'])) {
                    $allDesignerCard[$key]['customer'] = Customer::findOrFail($item['customer_id']);
                }
            }

            return response()->json(NewDesignerCustomerResource::collection($allDesignerCard));
        } else {
            $pageNonexistentCustomers = PageNonexistentCustomers::where('page', $page)
                ->orderBy('priority')
                ->get()
                ->toArray();
            $allNonexistentCustomers = [];
            foreach ($pageNonexistentCustomers as $key => $value) {
                $allNonexistentCustomers[] = NonexistentCustomer::findOrFail($value['nonexistent_customers_id']);
                $allNonexistentCustomers[$key]['priority'] = $value['priority'];
                $allNonexistentCustomers[$key]['tab_priority'] = $value['tab_priority'];
            }

            return response()->json(NewNonexistentCustomerResource::collection($allNonexistentCustomers));
        }
    }

    /**
     * @param string $type
     * @param int $id
     * @param AccessDatabaseContent $tableContent
     * @param CasesDatabaseContent $casesContent
     * @return JsonResponse
     */
    public function getCustomerVc(
        string $type,
        int $id,
        AccessDatabaseContent $tableContent,
        CasesDatabaseContent $casesContent
    ): JsonResponse
    {
        if ($type == 'designer') {
            $dataVc = $this->getVcForDesignerPage($id, $tableContent, $casesContent)->getData();
        } elseif ($type == 'not-designer') {
            $dataVc = $this->getNonexistentCaseVC($id)->getData();
        }

        return response()->json($dataVc ?? null);
    }
}
