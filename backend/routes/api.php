<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeaturedController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\CatDecoracioneController;
use App\Http\Controllers\CatFlaneController;
use App\Http\Controllers\CatPanaderiaController;
use App\Http\Controllers\CatPasteleController;
use App\Http\Controllers\CatReposteriaController;
use App\Http\Controllers\CarritoVentaController;
use App\Http\Controllers\UserController;

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

Route::get('/user', function (Request $request) {
    return $request->user();
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//api usuarios
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::patch('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});
//api featureds
Route::get('/featureds', [FeaturedController::class, 'index']);
Route::post('/featureds', [FeaturedController::class, 'store']);
Route::get('/featureds/{featureds}', [FeaturedController::class, 'show']);
Route::patch('/featureds/{featured}', [FeaturedController::class, 'update']);
Route::delete('/featureds/{featured}', [FeaturedController::class, 'destroy']);
// //api promotions
Route::get('/promotions', [PromotionController::class, 'index']);
Route::post('/promotions', [PromotionController::class, 'store']);
Route::get('/promotions/{promotions}', [PromotionController::class, 'show']);
Route::patch('/promotions/{promotion}', [PromotionController::class, 'update']);
Route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy']);
// //api testimonials
Route::get('/testimonials', [TestimonialController::class, 'index']);
Route::post('/testimonials', [TestimonialController::class, 'store']);
Route::get('/testimonials/{testimonials}', [TestimonialController::class, 'show']);
Route::patch('/testimonials/{testimonial}', [TestimonialController::class, 'update']);
Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy']);
// //api catdecoraciones
Route::get('/catdecoraciones', [CatDecoracioneController::class, 'index']);
Route::post('/catdecoraciones', [CatDecoracioneController::class, 'store']);
Route::get('/catdecoraciones/{catDecoraciones}', [CatDecoracioneController::class, 'show']);
Route::patch('/catdecoraciones/{catDecoracione}', [CatDecoracioneController::class, 'update']);
Route::delete('/catdecoraciones/{catDecoracione}', [CatDecoracioneController::class, 'destroy']);
// //api CatFlanesController
Route::get('/catflanes', [CatFlaneController::class, 'index']);
Route::post('/catflanes', [CatFlaneController::class, 'store']);
Route::get('/catflanes/{catFlanes}', [CatFlaneController::class, 'show']);
Route::patch('/catflanes/{catFlane}', [CatFlaneController::class, 'update']);
Route::delete('/catflanes/{catFlane}', [CatFlaneController::class, 'destroy']);
// //api CatPanaderiaController
Route::get('/catpanaderia', [CatPanaderiaController::class, 'index']);
Route::post('/catpanaderia', [CatPanaderiaController::class, 'store']);
Route::get('/catpanaderia/{catPanaderia}', [CatPanaderiaController::class, 'show']);
Route::patch('/catpanaderia/{catPanaderia}', [CatPanaderiaController::class, 'update']);
Route::delete('/catpanaderia/{catPanaderia}', [CatPanaderiaController::class, 'destroy']);
// //api CatPasteleController
Route::get('/catpasteles', [CatPasteleController::class, 'index']);
Route::post('/catpasteles', [CatPasteleController::class, 'store']);
Route::get('/catpasteles/{id}', [CatPasteleController::class, 'show']);
Route::patch('/catpasteles/{catPastele}', [CatPasteleController::class, 'update']);
Route::delete('/catpasteles/{catPastele}', [CatPasteleController::class, 'destroy']);
// //api CatReposteriaController
Route::get('/catreposteria', [CatReposteriaController::class, 'index']);
Route::post('/catreposteria', [CatReposteriaController::class, 'store']);
Route::get('/catreposteria/{catReposteria}', [CatReposteriaController::class, 'show']);
Route::patch('/catreposteria/{catReposteria}', [CatReposteriaController::class, 'update']);
Route::delete('/catreposteria/{catReposteria}', [CatReposteriaController::class, 'destroy']);
//api CarritoVentaController
Route::get('/carrito', [CarritoVentaController::class, 'index']);
Route::get('/carrito/{idusers}', [CarritoVentaController::class, 'showiduser']);
Route::post('/carrito', [CarritoVentaController::class, 'store']);
Route::delete('/ccarrito/{idusers}', [CarritoVentaController::class, 'vaciarCarrito']);
Route::delete('/carrito/{carritoVenta}', [CarritoVentaController::class, 'destroy']);
