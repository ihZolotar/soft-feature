<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* ApiController */
Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () {
    Route::get('/get-data-vc-designer/{id}', 'ApiController@getVcForDesignerPage');
    Route::get('/get-designer-img', 'ApiController@getDesignerPageImg');
    Route::get('/get-reviews/{url}', 'ApiController@getReviews');
    Route::get('/get-offices-info', 'ApiController@getOfficesInfo');
    Route::get('/customer/{domain}', 'ApiController@getCustomersDomain');
    Route::get('/get-vc-nonexistent-customers/{id}', 'ApiController@getNonexistentCaseVC');
    Route::get('/get-import-info/{type}', 'ApiController@getInfoOneC');
    Route::get('/get-project-map', 'ApiController@getAllProjectMap');
    Route::get('/cv/{page}', 'ApiController@cvByPage');
    Route::get('/video', 'ApiController@getAllVideo');
    Route::get('/trip/{count?}', 'ApiController@getTrip');
    Route::get('/customer-card/{page}', 'ApiController@getCustomerCard');
    Route::get('/customer-vc/{type}/{id}', 'ApiController@getCustomerVc');
});