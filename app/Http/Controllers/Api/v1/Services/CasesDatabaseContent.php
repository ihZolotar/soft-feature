<?php

namespace App\Http\Controllers\Api\v1\Services;

use App\Models\{
    AdditionalSubgroupVc,
    CaseCV,
    CaseInfo,
    CasesArticle,
    CasesData,
    CasesFeatureData,
    CasesGroupVc,
    Customer,
    GroupSubgroupVc,
    NonexistentCustomer,
    PageNonexistentCustomers,
    Review,
    VisualConceptAdditionalSubgroup,
    VisualConceptGroup,
    VisualConceptSubgroup
};
use Illuminate\Database\Eloquent\{Builder, Collection, Model};

/**
 * Class CasesDatabaseContent
 * @package App\Http\Controllers\Api\v1\Services
 */
class CasesDatabaseContent
{
    /**
     * @param $name
     * @return bool|Builder|Model
     */
    public function getCaseInfo($name)
    {
        if (!empty($name)) {
            return CaseInfo::where('name', $name)->firstOrFail();
        }

        return false;
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function getCaseFeatureData($id)
    {
        if (!empty($id)) {
            return CasesFeatureData::where('cases_id', $id)->get()->toArray();
        }

        return false;
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function getCaseData($id)
    {
        if (!empty($id)) {
            $data = CasesData::where('cases_id', $id)->get();
            return $data->groupBy('unit')->toArray();
        }

        return false;
    }

    /**
     * @param bool $id
     * @return bool|Builder[]|Collection|string
     */
    public function getCaseCv($id = false)
    {
        if (!empty($id)) {
            return CaseCV::where('cases_id', $id)->get();
        }

        return false;
    }

    /**
     * @param bool $id
     * @return bool|Builder[]|Collection|string
     */
    public function getCaseArticle($id = false)
    {
        if (!empty($id)) {
            return CasesArticle::where('cases_id', $id)->get();
        }

        return false;
    }

    /**
     * @param $id
     * @return array|bool|string
     */
    public function getVisualConcept($id)
    {
        if (!empty($id)) {
            $group = CasesGroupVc::where('cases_id', $id)->orderBy('priority')->get()->toArray();

            return $this->vcDataGroup($group);
        }

        return false;
    }

    /**
     * @param $group
     * @return array
     */
    public function vcDataGroup($group): array
    {
        $data = [];
        foreach ($group as $key => $value) {
            $data[$key] = VisualConceptGroup::findOrFail($value['group_id'])->toArray();
            $subgroup = GroupSubgroupVc::where('group_id', $value['group_id'])
                ->orderBy('priority')
                ->get()
                ->toArray();
            if (!empty($subgroup)) {
                $data[$key]['subgroup'] = $this->getSubgroup($subgroup);
            }
        }

        return $data;
    }

    /**
     * @param $subgroup
     * @return array
     */
    public function getSubgroup($subgroup): array
    {
        $data = [];
        foreach ($subgroup as $subKey => $item) {
            if (!empty($item)) {
                $data[$subKey] = VisualConceptSubgroup::findOrFail($item['subgroup_id'])
                    ->toArray();
                $additionalSubgroup = AdditionalSubgroupVc::where('subgroup_id', $item['subgroup_id'])
                    ->orderBy('priority')
                    ->get()
                    ->toArray();
                if (!empty($additionalSubgroup)) {
                    foreach ($additionalSubgroup as $value) {
                        $data[$subKey]['additional'][] = VisualConceptAdditionalSubgroup::findOrFail($value['additional_subgroup_id'])->toArray();
                    }
                }
            }
        }

        return $data;
    }

    /**
     * @param string $rout
     * @return array|bool|string
     */
    public function getNonexistentCustomerForPage(string $rout)
    {
        if (!empty($rout)) {
            $pageNonexistentCustomers = PageNonexistentCustomers::where('page', $rout)
                ->orderBy('priority')
                ->get()
                ->toArray();
            $nonexistentCustomers = [];
            foreach ($pageNonexistentCustomers as $key => $value) {
                $nonexistentCustomers[$key] = NonexistentCustomer::findOrFail($value['nonexistent_customers_id'])
                    ->toArray();
                $nonexistentCustomers[$key]['priority'] = $value['priority'];
                $nonexistentCustomers[$key]['tab_priority'] = $value['tab_priority'];
            }

            return $nonexistentCustomers;
        }

        return false;
    }

    /**
     * Gets records in which the specified domain is.
     *
     * @return array
     */
    public function getCustomersForDomain(): array
    {
        return Customer::all()->toArray();
    }

    /**
     * @return array|string
     */
    public function getReviewsForPage()
    {
        $allReviews = Review::whereNotNull('priority')->orderBy('priority')->get();
        $all = $allReviews->toArray();
        foreach ($allReviews as $key => $item) {
            if ($item['case_id']) {
                $case = $item->currentCase()->get();
                $all[$key]['case'] = $case[0]->toArray();
            }
        }

        return $all;
    }
}
