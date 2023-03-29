<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//api featureds
Route::get('/featureds', 'App\Http\Controllers\FeaturedsController@index');
Route::post('/featureds', 'App\Http\Controllers\FeaturedsController@store');
Route::get('/featureds/{featureds}', 'App\Http\Controllers\FeaturedsController@show');
Route::put('/featureds/{featureds}', 'App\Http\Controllers\FeaturedsController@update');
Route::delete('/featureds/{featureds}', 'App\Http\Controllers\FeaturedsController@destroy');
//api promotions
Route::get('/promotions', 'App\Http\Controllers\PromotionsController@index');
Route::post('/promotions', 'App\Http\Controllers\PromotionsController@store');
Route::get('/promotions/{promotions}', 'App\Http\Controllers\PromotionsController@show');
Route::put('/promotions/{promotions}', 'App\Http\Controllers\PromotionsController@update');
Route::delete('/promotions/{promotions}', 'App\Http\Controllers\PromotionsController@destroy');
//api testimonials
Route::get('/testimonials', 'App\Http\Controllers\TestimonialsController@index');
Route::post('/testimonials', 'App\Http\Controllers\TestimonialsController@store');
Route::get('/testimonials/{testimonials}', 'App\Http\Controllers\TestimonialsController@show');
Route::put('/testimonials/{testimonials}', 'App\Http\Controllers\TestimonialsController@update');
Route::delete('/testimonials/{testimonials}', 'App\Http\Controllers\TestimonialsController@destroy');