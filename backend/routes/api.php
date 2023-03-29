<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeaturedsController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\TestimonialsController;
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
Route::get('/featureds', [FeaturedsController::class, 'index']);
Route::post('/featureds', [FeaturedsController::class, 'store']);
Route::get('/featureds/{id}', [FeaturedsController::class, 'show']);
Route::patch('/featureds/{id}', [FeaturedsController::class, 'update']);
Route::delete('/featureds/{id}', [FeaturedsController::class, 'destroy']);
//api promotions
Route::get('/promotions', [PromotionsController::class, 'index']);
Route::post('/promotions', [PromotionsController::class, 'store']);
Route::get('/promotions/{id}', [PromotionsController::class, 'show']);
Route::patch('/promotions/{id}', [PromotionsController::class, 'update']);
Route::delete('/promotions/{id}', [PromotionsController::class, 'destroy']);
//api testimonials
Route::get('/testimonials', [TestimonialsController::class, 'index']);
Route::post('/testimonials', [TestimonialsController::class, 'store']);
Route::get('/testimonials/{id}', [TestimonialsController::class, 'show']);
Route::patch('/testimonials/{id}', [TestimonialsController::class, 'update']);
Route::delete('/testimonials/{id}', [TestimonialsController::class, 'destroy']);