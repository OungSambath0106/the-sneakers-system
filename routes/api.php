<?php

use App\Http\Controllers\API\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// create api here


// (login)
Route::post('login', [ApiController::class, 'login']);

//Route for onboard
Route::get('get_shoes_slider',[ApiController::class,'getShoesSlider']);
// (Get Promotion)
Route::get('get_promotion', [ApiController::class, 'getPromotion']);
// (Get Promotion Detail)
Route::get('get_promotion_detail', [ApiController::class, 'getPromotionDetail']);
// (Get Baner Slider)
Route::get('get_baner_slider', [ApiController::class, 'getBanerSlider']);
// (Get Brand)
Route::get('get_brand', [ApiController::class, 'getBrand']);
// (Get Brand Detail)
Route::get('get_brand_detail', [ApiController::class, 'getBrandDetail']);
// (Get Product)
Route::get('get_product', [ApiController::class, 'getProduct']);
// (Search Product)
Route::get('/products/search', [ApiController::class, 'searchProduct']);
// (Get Product Detail)
Route::get('get_product_detail', [ApiController::class, 'GetProductDetail']);

Route::middleware(['auth:api'])->group(function () {
    // (Get Config)
    Route::get('get_config', [ApiController::class, 'getConfig']);
    // (Get User)
    Route::get('get_user', [ApiController::class, 'getUser']);
    // (logout)
    Route::get('logout', [ApiController::class, 'logout']);

    // (Order)
    Route::post('/orders', [ApiController::class, 'storeOrder']);
    Route::get('order/{id}', [ApiController::class, 'showOrder']);
});

// (Customer Register)
Route::post('customer_register', [ApiController::class, 'customerRegister']);
// (Customer Login)
Route::post('customer_login', [ApiController::class, 'customerLogin']);

Route::middleware(['auth:customer'])->group(function () {
    // // (Order)
    // Route::post('/orders', [ApiController::class, 'storeOrder']);
    // Route::get('order/{id}', [ApiController::class, 'showOrder']);

    Route::get('customer_dashboard', [ApiController::class, 'customerDashboard']);
});

Route::post('register-with-phone', [ApiController::class, 'customerRegisterWithPhone']);
Route::post('verify-otp-and-register', [ApiController::class, 'verifyOtpAndRegister']);
