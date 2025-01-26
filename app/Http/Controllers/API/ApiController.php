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
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\ShoesSlider;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getBrand(Request $request)
    {
        $brands = Brand::where('status', '1')
                    ->select('id', 'name', 'image', 'status')
                    ->paginate(10);

        $brands->getCollection()->transform(function ($brand) {
            $brand->image = asset('uploads/brand/' . $brand->image);
            return $brand;
        });

        if ($brands->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        }

        return response()->json($brands, 200);
    }

    public function getBrandDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:brands,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $id = $request->input('id');
        $brand = Brand::where('id', $id)
            ->select('id', 'name', 'image', 'status')
            ->where('status', 1)
            ->first();

        if (!$brand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        $brand->image = asset('uploads/brand/' . $brand->image);

        return response()->json($brand, 200);
    }

    public function getBannerSlider()
    {
        $baner_slider = Baner::where('status', 1)
                        ->select('id', 'name', 'image', 'status')
                        ->get();
        $baner_slider = $baner_slider->map(function ($baner) {
            $baner->image = asset('uploads/banner-slider/' . $baner->image);
            return $baner;
        });

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

    public function getShoesSlider()
    {
        $shoes_slider = ShoesSlider::where('status', 1)
                    ->select('id', 'title', 'image', 'status')
                    ->get();

        $shoes_slider = $shoes_slider->map(function ($shoes) {
            $shoes->image = asset('uploads/shoes-slider/' . $shoes->image);
            return $shoes;
        });

        if ($shoes_slider->isEmpty()) {
            return response()->json(['message' => 'No Record Found'], 200);
        }

        return response()->json($shoes_slider, 200);
    }

    public function getProduct(Request $request)
    {
        $query = Product::where('status', '1')
            ->with(['productgallery' => function($query) {
                $query->select('id', 'product_id', 'images');
            }])
            ->select('id', 'name', 'rating', 'product_info');

        $products = $query->paginate(10);

        $products->getCollection()->transform(function ($product) {
            if (is_array($product->product_info) && count($product->product_info) > 0) {
                $product->product_info = $product->product_info[0]['product_price'] ?? null;
            } else {
                $product->product_info = null;
            }

            if ($product->productgallery) {
                $images = $product->productgallery->images;
                if (is_array($images) && count($images) > 0) {
                    $product->productgallery->images = [asset($images[0])];
                } else {
                    $product->productgallery->images = [];
                }
            }

            return $product;
        });

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        }

        return response()->json($products, 200);
    }

    public function getProductNewArrival(Request $request)
    {
        $query = Product::where('status', '1')
            ->where('new_arrival', '1')
            ->with(['productgallery' => function($query) {
                $query->select('id', 'product_id', 'images');
            }])
            ->select('id', 'name', 'rating', 'product_info');

        $products = $query->paginate(10);

        $products->getCollection()->transform(function ($product) {
            if (is_array($product->product_info) && count($product->product_info) > 0) {
                $product->product_info = $product->product_info[0]['product_price'] ?? null;
            } else {
                $product->product_info = null;
            }

            if ($product->productgallery) {
                $images = $product->productgallery->images;
                if (is_array($images) && count($images) > 0) {
                    $product->productgallery->images = [asset($images[0])];
                } else {
                    $product->productgallery->images = [];
                }
            }

            return $product;
        });

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        }

        return response()->json($products, 200);
    }

    public function getProductRecommended(Request $request)
    {
        $query = Product::where('status', '1')
            ->where('recommended', '1')
            ->with(['productgallery' => function($query) {
                $query->select('id', 'product_id', 'images');
            }])
            ->select('id', 'name', 'rating', 'product_info');

        $products = $query->paginate(10);

        $products->getCollection()->transform(function ($product) {
            if (is_array($product->product_info) && count($product->product_info) > 0) {
                $product->product_info = $product->product_info[0]['product_price'] ?? null;
            } else {
                $product->product_info = null;
            }

            if ($product->productgallery) {
                $images = $product->productgallery->images;
                if (is_array($images) && count($images) > 0) {
                    $product->productgallery->images = [asset($images[0])];
                } else {
                    $product->productgallery->images = [];
                }
            }

            return $product;
        });

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        }

        return response()->json($products, 200);
    }

    public function getProductPopular(Request $request)
    {
        $query = Product::where('status', '1')
            ->where('popular', '1')
            ->with(['productgallery' => function($query) {
                $query->select('id', 'product_id', 'images');
            }])
            ->select('id', 'name', 'rating', 'product_info');

        $products = $query->paginate(10);

        $products->getCollection()->transform(function ($product) {
            if (is_array($product->product_info) && count($product->product_info) > 0) {
                $product->product_info = $product->product_info[0]['product_price'] ?? null;
            } else {
                $product->product_info = null;
            }

            if ($product->productgallery) {
                $images = $product->productgallery->images;
                if (is_array($images) && count($images) > 0) {
                    $product->productgallery->images = [asset($images[0])];
                } else {
                    $product->productgallery->images = [];
                }
            }

            return $product;
        });

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
            ->select('id', 'name', 'rating', 'product_info');

        $products = $query->paginate(10);

        $products->getCollection()->transform(function ($product) {
            if (is_array($product->product_info) && count($product->product_info) > 0) {
                $product->product_info = $product->product_info[0]['product_price'] ?? null;
            } else {
                $product->product_info = null;
            }

            if ($product->productgallery) {
                $images = $product->productgallery->images;
                if (is_array($images) && count($images) > 0) {
                    $product->productgallery->images = [asset('uploads/products/' . $images[0])];
                } else {
                    $product->productgallery->images = [];
                }
            }

            return $product;
        });

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

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Map the images in the product gallery to full URLs
        if ($product->productgallery) {
            $product->productgallery->images = array_map(function($image) {
                return asset('uploads/products/' . $image);
            }, $product->productgallery->images);
        }

        unset($product->created_by, $product->deleted_at, $product->created_at, $product->updated_at);

        return response()->json($product, 200);
    }

    public function getPromotion(Request $request)
    {
        $currentDate = Carbon::now();

        $promotions = Promotion::where('status', '1')
            ->with('activeProducts.productgallery', 'activeBrands')
            ->with(['promotiongallery' => function($query) {
                $query->select('id', 'promotion_id', 'images');
            }])
            ->whereDate('start_date', '<=', $currentDate)
            ->whereDate('end_date', '>=', $currentDate)
            ->select('id', 'title', 'description', 'promotion_type', 'discount_type', 'percent', 'amount', 'start_date', 'end_date')
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
                    'productgallery' => $product->productgallery ? array_map(function($image) {
                        return asset('uploads/products/' . $image);
                    }, $product->productgallery->images) : null
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

            // Map the images in the promotion gallery to full URLs
            if ($promotion->promotiongallery) {
                $promotion->promotiongallery->images = array_map(function($image) {
                    return asset('uploads/promotions/' . $image);
                }, $promotion->promotiongallery->images);
            }

            return $promotion;
        });

        if ($promotions->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        }

        return response()->json($promotions, 200);
    }

    public function getPromotionDetail(Request $request)
    {
        // Validate the input 'id'
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $id = $request->input('id');
        $currentDate = Carbon::now();

        // Fetch the promotion with necessary relationships
        $promotion = Promotion::where('id', $id)
            ->where('status', 1)
            ->whereDate('start_date', '<=', $currentDate)
            ->whereDate('end_date', '>=', $currentDate)
            ->with('activeProducts.productgallery', 'activeBrands')
            ->with(['promotiongallery' => function ($query) {
                $query->select('id', 'promotion_id', 'images');
            }])
            ->first();

        // Return 404 if the promotion is not found
        if (!$promotion) {
            return response()->json(['error' => 'Promotion not found'], 404);
        }

        // Remove unwanted fields (created_at, updated_at)
        unset($promotion->created_at, $promotion->updated_at);

        // Map the products and add necessary information
        $promotion->products = $promotion->activeProducts->map(function ($product) {
            $productData = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'brand_id' => $product->brand_id,
                'status' => $product->status,
                'product_info' => $product->product_info,
                'rating' => $product->rating,
                'count_product_sale' => $product->count_product_sale,
                'new_arrival' => $product->new_arrival,
                'recommended' => $product->recommended,
                'popular' => $product->popular
            ];

            // Safely map the product's gallery images if they exist
            if ($product->productgallery) {
                $productData['productgallery'] = array_map(function ($image) {
                    return asset('uploads/products/' . $image);
                }, $product->productgallery->images);
            } else {
                $productData['productgallery'] = null; // No gallery found
            }

            return $productData;
        });

        unset($promotion->activeProducts); // Remove unnecessary activeProducts data

        // Map the brands associated with the promotion
        $promotion->brands = $promotion->activeBrands->map(function ($brand) {
            return [
                'id' => $brand->id,
                'name' => $brand->name,
                'images_url' => $brand->images_url ? asset('uploads/brands/' . $brand->images_url) : null // Safe URL generation
            ];
        });

        unset($promotion->activeBrands); // Remove unnecessary activeBrands data

        // Safely map the promotion gallery images
        if ($promotion->promotiongallery) {
            $promotion->promotiongallery->images = array_map(function ($image) {
                return asset('uploads/promotions/' . $image);
            }, $promotion->promotiongallery->images);
        } else {
            $promotion->promotiongallery->images = []; // Default to an empty array if no gallery images exist
        }

        return response()->json($promotion, 200);
    }

    // Order
    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_amount' => 'required|numeric',
            'discount_amount' => 'nullable|numeric',
            'discount_type' => 'nullable|string',
            'shipping_method' => 'nullable|string',
            'shipping_address' => 'nullable|string',
            'shipping_fee' => 'nullable|numeric',
            'payment_status' => 'required|in:unpaid,paid',
            'payment_method' => 'required|in:cash_on_delivery,ABA,AC',
            'order_note' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'order_details' => 'required|array',
            'order_details.*.product_id' => 'required|exists:products,id',
            'order_details.*.brand_id' => 'required|exists:brands,id',
            'order_details.*.product_qty' => 'required|integer|min:1',
            'order_details.*.product_price' => 'required|numeric',
            'order_details.*.product_size' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $order = Order::create($validated);

            foreach ($validated['order_details'] as $detail) {
                $order_detail = new OrderDetail();
                $order_detail->order_id = $order->id;
                $order_detail->product_id = $detail['product_id'];
                $order_detail->brand_id = $detail['brand_id'];
                $order_detail->product_qty = $detail['product_qty'];
                $order_detail->product_price = $detail['product_price'];
                $order_detail->product_size = $detail['product_size'];
                $order_detail->discount = $detail['discount'];
                $order_detail->discount_type = $detail['discount_type'];
                $order_detail->save();
                $product = Product::findOrFail($detail['product_id']);
                $productInfo = $product->product_info;
                $productInfoArray = is_array($productInfo) ? $productInfo : json_decode($productInfo, true);

                $matchingSize = null;
                foreach ($productInfoArray as &$info) {
                    if ($info['product_size'] === $detail['product_size']) {
                        $matchingSize = &$info;
                        break;
                    }
                }

                if ($matchingSize) {
                    if ($matchingSize['product_qty'] >= $detail['product_qty']) {
                        $matchingSize['product_qty'] -= $detail['product_qty'];
                    } else {
                        throw new \Exception(
                            "Insufficient quantity for product ID {$detail['product_id']} (Size: {$detail['product_size']}).
                            Available: {$matchingSize['product_qty']}, Requested: {$detail['product_qty']}"
                        );
                    }
                } else {
                    throw new \Exception("Product size {$detail['product_size']} not found for product ID {$detail['product_id']}.");
                }

                $product->product_info = array_map(function($info) {
                    $info['product_qty'] = (string) $info['product_qty'];
                    return $info;
                }, $productInfoArray);
                $product->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => $order->load('details')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function showOrder($id)
    {
        $order = Order::with('details')->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);
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
        // Validate request data
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $customer = Customer::where('email', $validated['email'])->first();

        if (!$customer || !Hash::check($validated['password'], $customer->password)) {
            return response()->json([
                'message' => 'Invalid credentials.',
            ], 401);
        }

        $customer->tokens()->delete();
        $token = $customer->createToken('CustomerAccessToken')->accessToken;
        return response()->json([
            'message' => 'Login successful!',
            'token' => $token,
            'customer' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
            ],
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
