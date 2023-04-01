<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeaturedsController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\CatDecoracionesController;
use App\Http\Controllers\CatFlanesController;
use App\Http\Controllers\CatPanaderiaController;
use App\Http\Controllers\CatPastelesController;
use App\Http\Controllers\CatReposteriaController;

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
Route::get('/featureds/{featureds}', [FeaturedsController::class, 'show']);
Route::patch('/featureds/{featureds}', [FeaturedsController::class, 'update']);
Route::delete('/featureds/{featureds}', [FeaturedsController::class, 'destroy']);
//api promotions
Route::get('/promotions', [PromotionsController::class, 'index']);
Route::post('/promotions', [PromotionsController::class, 'store']);
Route::get('/promotions/{promotions}', [PromotionsController::class, 'show']);
Route::patch('/promotions/{promotions}', [PromotionsController::class, 'update']);
Route::delete('/promotions/{promotions}', [PromotionsController::class, 'destroy']);
//api testimonials
Route::get('/testimonials', [TestimonialsController::class, 'index']);
Route::post('/testimonials', [TestimonialsController::class, 'store']);
Route::get('/testimonials/{testimonials}', [TestimonialsController::class, 'show']);
Route::patch('/testimonials/{testimonials}', [TestimonialsController::class, 'update']);
Route::delete('/testimonials/{testimonials}', [TestimonialsController::class, 'destroy']);
//api catdecoraciones
Route::get('/catdecoraciones', [CatDecoracionesController::class, 'index']);
Route::post('/catdecoraciones', [CatDecoracionesController::class, 'store']);
Route::get('/catdecoraciones/{catDecoraciones}', [CatDecoracionesController::class, 'show']);
Route::patch('/catdecoraciones/{catDecoraciones}', [CatDecoracionesController::class, 'update']);
Route::delete('/catdecoraciones/{catDecoraciones}', [CatDecoracionesController::class, 'destroy']);
//api CatFlanesController
Route::get('/catflanes', [CatFlanesController::class, 'index']);
Route::post('/catflanes', [CatFlanesController::class, 'store']);
Route::get('/catflanes/{catFlanes}', [CatFlanesController::class, 'show']);
Route::patch('/catflanes/{catFlanes}', [CatFlanesController::class, 'update']);
Route::delete('/catflanes/{catFlanes}', [CatFlanesController::class, 'destroy']);
//api CatPanaderiaController
Route::get('/catpanaderia', [CatPanaderiaController::class, 'index']);
Route::post('/catpanaderia', [CatPanaderiaController::class, 'store']);
Route::get('/catpanaderia/{catPanaderia}', [CatPanaderiaController::class, 'show']);
Route::patch('/catpanaderia/{catPanaderia}', [CatPanaderiaController::class, 'update']);
Route::delete('/catpanaderia/{catPanaderia}', [CatPanaderiaController::class, 'destroy']);
//api CatPanaderiaController
Route::get('/catpasteles', [CatPastelesController::class, 'index']);
Route::post('/catpasteles', [CatPastelesController::class, 'store']);
Route::get('/catpasteles/{catPasteles}', [CatPastelesController::class, 'show']);
Route::patch('/catpasteles/{catPasteles}', [CatPastelesController::class, 'update']);
Route::delete('/catpasteles/{catPasteles}', [CatPastelesController::class, 'destroy']);
//api CatPanaderiaController
Route::get('/catreposteria', [CatReposteriaController::class, 'index']);
Route::post('/catreposteria', [CatReposteriaController::class, 'store']);
Route::get('/catreposteria/{catReposteria}', [CatReposteriaController::class, 'show']);
Route::patch('/catreposteria/{catReposteria}', [CatReposteriaController::class, 'update']);
Route::delete('/catreposteria/{catReposteria}', [CatReposteriaController::class, 'destroy']);
