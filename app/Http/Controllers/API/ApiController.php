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
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getBrand(Request $request)
    {
        $brands = Brand::where('status', '1')
                ->select('id', 'name', 'images', 'status')
                ->paginate(10);

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
            ->select('id', 'name', 'images', 'status')
            ->where('status', 1)
            ->first();

        if (!$brand) {
            return response()->json(['error' => 'brand not found'], 404);
        }

        return response()->json($brand, 200);
    }

    public function getBanerSlider()
    {
        $baner_slider = Baner::where('status', 1)
                        ->select('id', 'name', 'image', 'status')
                        ->get();

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
        $onboards = Onboard::where('status', 1)
                    ->select('id', 'title', 'image', 'status')
                    ->get();

        if ($onboards->isEmpty()) {
            return response()->json(['message' => 'No Record Found'], 200);
        }

        return response()->json($onboards, 200);
    }

    public function getProduct(Request $request)
    {
        $query = Product::where('status', '1')
            ->with(['productgallery' => function($query) {
                $query->select('id', 'product_id', 'images');
            }])
            ->select('id', 'name', 'description', 'brand_id', 'new_arrival', 'recommended', 'popular', 'count_product_sale', 'rating', 'product_info');

        if ($request->has('new_arrival')) {
            $query->where('new_arrival', $request->input('new_arrival'));
        }

        if ($request->has('recommended')) {
            $query->where('recommended', $request->input('recommended'));
        }

        if ($request->has('popular')) {
            $query->where('popular', $request->input('popular'));
        }

        $products = $query->paginate(10);

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        }

        return response()->json($products, 200);
    }

    public function searchProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $searchTerm = $request->input('name');

        $query = Product::where('status', '1')
            ->where('name', 'LIKE', '%' . $searchTerm . '%')
            ->with(['productgallery' => function ($query) {
                $query->select('id', 'product_id', 'images');
            }])
            ->select('id', 'name', 'description', 'brand_id', 'new_arrival', 'recommended', 'popular', 'count_product_sale', 'rating', 'product_info');

        $products = $query->paginate(10);

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No matching products found'], 404);
        }

        return response()->json($products, 200);
    }


    public function getProductDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $product = Product::where('id', $request->input('id'))
            ->where('status', 1)
            ->with(['productgallery' => function ($query) {
                $query->select('id', 'product_id', 'images');
            }])
            ->first();

        unset($product->created_by, $product->deleted_at, $product->created_at, $product->updated_at);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    public function getPromotion(Request $request)
    {
        $currentDate = Carbon::now();

        $promotions = Promotion::where('status', '1')
            ->with('activeProducts.productgallery', 'activeBrands')
            ->whereDate('start_date', '<=', $currentDate)
            ->whereDate('end_date', '>=', $currentDate)
            ->select('id', 'title', 'description', 'promotion_type', 'discount_type','percent', 'amount', 'banner', 'start_date', 'end_date')
            ->get();
        $promotions->transform(function ($promotion) {
            unset($promotion->products);
            $promotion->products = $promotion->activeProducts->map(function ($product) {
                $product = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'brand_id' => $product->brand_id,
                    'status' => $product->status,
                    'product_info' => $product->product_info,
                    'rating' => $product->rating,
                    'count_product_sale' => $product->count_product_sale,
                    'productgallery' => $product->productgallery->images_url
                ];
                return $product;
            });
            unset($promotion->activeProducts);
            $promotion->brands = $promotion->activeBrands->map(function ($brand) {
                $brand = [
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'images_url' => $brand->images_url
                ];
                return $brand;
            });
            unset($promotion->activeBrands);
            return $promotion;
        });

        if ($promotions->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        }

        return response()->json($promotions, 200);
    }

    public function getPromotionDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
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
            ->with('activeProducts.productgallery', 'activeBrands')
            ->first();

        if (!$promotion) {
            return response()->json(['error' => 'Promotion not found'], 404);
        }

        unset($promotion->created_at, $promotion->updated_at);

        $promotion->products = $promotion->activeProducts->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'brand_id' => $product->brand_id,
                'status' => $product->status,
                'product_info' => $product->product_info,
                'rating' => $product->rating,
                'count_product_sale' => $product->count_product_sale,
                'productgallery' => $product->productgallery->images_url,
                'new_arrival' => $product->new_arrival,
                'recommended' => $product->recommended,
                'popular' => $product->popular
            ];
        });

        unset($promotion->activeProducts);

        $promotion->brands = $promotion->activeBrands->map(function ($brand) {
            return [
                'id' => $brand->id,
                'name' => $brand->name,
                'images_url' => $brand->images_url
            ];
        });

        unset($promotion->activeBrands);

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

    public function customerRegister(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $customer = Customer::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'gender' => $validated['gender'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return response()->json([
                'message' => 'Customer registered successfully!',
                'customer' => $customer,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Registration failed. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function customerLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $customer = Customer::where('email', $validated['email'])->first();

        if (!$customer || !Hash::check($validated['password'], $customer->password)) {
            return response()->json([
                'message' => 'Invalid email or password.',
            ], 401);
        }

        // Generate a personal access token
        $token = $customer->createToken('accessToken')->accessToken ?? null;

        return response()->json([
            'message' => 'Login successful!',
            'token' => $token,
            'customer' => $customer,
        ], 200);
    }

    public function customerRegisterWithPhone(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|unique:customers,phone',
        ]);

        try {
            $otp = rand(100000, 999999);

            Cache::put('otp_' . $validated['phone'], $otp, now()->addMinutes(5));

            $this->sendOtp($validated['phone'], $otp);

            return response()->json([
                'message' => 'OTP sent to your phone!',
                'phone' => $validated['phone'],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send OTP. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function verifyOtpAndRegister(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required',
            'otp' => 'required|digits:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required|string|in:male,female',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $cachedOtp = Cache::get('otp_' . $validated['phone']);

            if (!$cachedOtp || $cachedOtp != $validated['otp']) {
                return response()->json([
                    'message' => 'Invalid or expired OTP.',
                ], 400);
            }

            $customer = Customer::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'gender' => $validated['gender'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            Cache::forget('otp_' . $validated['phone']);

            $token = $customer->createToken('accessToken')->accessToken;

            return response()->json([
                'message' => 'Customer registered successfully!',
                'customer' => $customer,
                'access_token' => $token,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Registration failed. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function sendOtp($phone, $otp)
    {
        $response = Http::post('https://textbelt.com/text', [
            'phone' => $phone,
            'message' => "Your OTP is: $otp",
            'key' => 'textbelt',
        ]);

        return $response->json();
    }
}
