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
Route::get('get_shoes_sliders',[ApiController::class,'getShoesSlider']);
// (Get Promotion)
Route::get('get_promotions', [ApiController::class, 'getPromotion']);
// (Get Promotion Detail)
Route::get('get_promotion_detail', [ApiController::class, 'getPromotionDetail']);
// (Get Baner Slider)
Route::get('get_banner_sliders', [ApiController::class, 'getBannerSlider']);
// (Get Brand)
Route::get('get_brands', [ApiController::class, 'getBrand']);
// (Get Brand Detail)
Route::get('get_brand_detail', [ApiController::class, 'getBrandDetail']);
// (Get Product)
Route::get('get_products', [ApiController::class, 'getProduct']);
// (Get Product New Arrival)
Route::get('get_products_new_arrival', [ApiController::class, 'getProductNewArrival']);
// (Get Product Recommended)
Route::get('get_products_recommended', [ApiController::class, 'getProductRecommended']);
// (Get Product Popular)
Route::get('get_products_popular', [ApiController::class, 'getProductPopular']);
// (Get Product by Brand)
Route::get('get_products_by_brand', [ApiController::class, 'getProductByBrand']);
// (Search Product)
Route::get('/products/search', [ApiController::class, 'searchProduct']);
// (Get Product Detail)
Route::get('get_product_detail', [ApiController::class, 'GetProductDetail']);

Route::middleware(['auth:api'])->group(function () {
    // (Get Config)
    Route::get('get_config', [ApiController::class, 'getConfig']);
    // (Get User)
    Route::get('get_users', [ApiController::class, 'getUser']);
    // (logout)
    Route::get('logout', [ApiController::class, 'logout']);
});

// (Customer Register)
Route::post('customer_register', [ApiController::class, 'customerRegister']);
// (Customer Login)
Route::post('customer_login', [ApiController::class, 'customerLogin']);

Route::middleware(['auth:customer'])->group(function () {
    Route::post('/orders', [ApiController::class, 'storeOrder']);
    // Route::get('order/{id}', [ApiController::class, 'showOrder']);
    Route::get('customer_dashboard', [ApiController::class, 'customerDashboard']);
});

// (Generate OTP)
Route::post('/generate-otp',[ApiController::class,'generateOTP']);

Route::post('register-with-phone', [ApiController::class, 'customerRegisterWithPhone']);
Route::post('verify-otp-and-register', [ApiController::class, 'verifyOtpAndRegister']);
