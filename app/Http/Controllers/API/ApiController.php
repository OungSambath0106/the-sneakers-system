<?php

namespace App\Http\Controllers\API;

use App\Models\Grade;
use App\Models\Compus;
use App\Models\Onboard;
use App\Models\Student;
use App\Models\Department;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use App\Http\Controllers\Controller;
use App\Models\Baner;
use App\Models\Brand;
use App\Models\News;
use App\Models\BusinessSetting;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getBrand(Request $request)
    {
        $brands = Brand::where('status', '1')->get();

        if ($brands->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        }

        return response()->json($brands, 200);
    }

    public function getBrandDetail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $id = $request->input('id');
        $brand = Brand::where('id', $id)
            ->where('status', 1)
            ->first();

        if (!$brand) {
            return response()->json(['error' => 'brand not found'], 404);
        }

        return response()->json($brand, 200);
    }

    public function getBanerSlider()
    {
        $baner_slider = Baner::where('status', 1)->get();

        if ($baner_slider->isEmpty()) {
            return response()->json(['message' => 'No Record Found'], 200);
        }

        return response()->json($baner_slider, 200);
    }

    public function getConfig(Request $request)
    {
        $configs = BusinessSetting::all();
        $data = [];

        foreach ($configs as $config) {
            $data[$config->type] = $config->value;

            if (in_array($config->type, ['language', 'pnc_language'])) {
                $data[$config->type] = json_decode($config->value, true);
            }

            if (in_array($config->type, ['web_header_logo', 'web_banner_logo', 'fav_icon'])) {
                if ($config->value && file_exists('uploads/business_settings/' . $config->value)) {
                    $data[$config->type] = asset('uploads/business_settings/' . $config->value);
                } else {
                    $data[$config->type] = asset('uploads/image/default.png');
                }
            }
        }

        return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }

    public function getOnboardScreen()
    {
        $onboards = Onboard::where('status', 1)->get();

        if ($onboards->isEmpty()) {
            return response()->json(['message' => 'No Record Found'], 200);
        }

        return response()->json($onboards, 200);
    }

    public function getProduct(Request $request)
    {
        $product = Product::where('status', '1')
            ->with('productgallery')
            ->select('id', 'name', 'description', 'brand_id', 'count_product_sale', 'rating', 'product_info')
            ->get();

        if ($product->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        }

        return response()->json($product, 200);
    }

    public function getProductDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $id = $request->input('id');
        $product = Product::where('id', $id)
            ->where('status', 1)
            ->with('productgallery')
            ->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    public function getPromotion(Request $request)
    {
        $currentDate = Carbon::now();

        $promotion = Promotion::where('status', '1')
            ->with('products.productgallery', 'brands')
            ->whereDate('start_date', '<=', $currentDate)
            ->whereDate('end_date', '>=', $currentDate)
            ->select('id', 'title', 'description', 'promotion_type', 'discount_type','percent', 'amount', 'banner', 'start_date', 'end_date')
            ->get();

        if ($promotion->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        }

        return response()->json($promotion, 200);
    }

    public function getPromotionDetail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $id = $request->input('id');
        $currentDate = Carbon::now();
        $promotion = Promotion::where('id', $id)
            ->where('status', 1)
            ->whereDate('start_date', '<=', $currentDate)
            ->whereDate('end_date', '>=', $currentDate)
            ->with('products.productgallery', 'brands')
            ->first();

        if (!$promotion) {
            return response()->json(['error' => 'Promotion not found'], 404);
        }

        return response()->json($promotion, 200);
    }

    public function getUser(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);

        if (!$user) {
            return response()->json(['message' => 'No records found'], 404);
        }

        return response()->json($user, 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                try {
                    $token = $user->createToken('accessToken')->accessToken;

                    return response()->json([
                        'access_token' => $token,
                        'user' => $user,
                        'message' => 'Login successful',
                    ], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'Token generation failed',
                    ], 500);
                }
            } else {
                Auth::logout();
                return response()->json([
                    'message' => 'Permission denied. Only admin can login',
                ], 403);
            }
        } else {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $request->user()->token()->revoke();

            return response()->json(['message' => 'Logged out successfully'], 200);
        }

        return response()->json(['message' => 'Logout failed'], 403);
    }
}
