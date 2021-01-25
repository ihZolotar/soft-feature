<?php

namespace App\Http\Controllers\Api\v1\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use App\Models\{Review, ReviewLocale, ReviewPage};
use Illuminate\Support\Facades\DB;

/**
 * Class ReviewsDatabaseContent
 * @package App\Services
 */
class ReviewsDatabaseContent
{
    /**
     * @param $countryCode
     * @return ReviewLocale[]|false|\Illuminate\Database\Eloquent\Builder[]|Collection|Builder[]|\Illuminate\Support\Collection|string
     */
    public static function getReviewsForLocale($countryCode)
    {
        if (!empty($countryCode)) {
            $reviewsLocale = ReviewLocale::where('country_code', $countryCode)->orderBy('priority')->get();
            foreach ($reviewsLocale as $key => $value) {
                $reviewsLocale[$key]['reviews'] = Review::findOrFail($value->review_id);
            }

            return $reviewsLocale;
        }

        return false;
    }

    /**
     * @param $countryCode
     * @return array|string
     */
    public function getReviewsForPageLocale($countryCode)
    {
        $query = DB::table('reviews')
            ->leftJoin('reviews_locale', 'reviews.id', '=', 'reviews_locale.review_id')
            ->where('reviews_locale.country_code', '=', $countryCode)
            ->get();
        $result = [];
        foreach ($query->toArray() as $review) {
            $result[] = (array)$review;
        }

        return $result;
    }

    /**
     * @param $rout
     * @return ReviewPage[]|false|\Illuminate\Database\Eloquent\Builder[]|Collection|Builder[]|\Illuminate\Support\Collection|string
     */
    public static function getReview($rout)
    {
        if (!empty($rout)) {
            $reviewsPage = ReviewPage::where('page', $rout)->orderBy('priority')->get();
            foreach ($reviewsPage as $key => $value) {
                $review = Review::findOrFail($value->review_id);
                $reviewsPage[$key]['reviews'] = $review;
                $reviewsPage[$key]['video'] = $review->video()->get(['poster', 'url', 'author', 'position']);
            }

            return $reviewsPage;
        }

        return false;
    }
}
