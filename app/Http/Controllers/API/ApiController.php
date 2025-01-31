<?php

namespace App\Http\Controllers\API;

use App\helpers\GlobalFunction;
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
            ->with(['productgallery' => function ($query) {
                $query->select('id', 'product_id', 'images');
            }])
            ->select('id', 'name', 'rating', 'product_info');

        $products = $query->paginate(10);

        $products->getCollection()->transform(function ($product) {
            if (is_array($product->product_info) && count($product->product_info) > 0) {
                $product->price = $product->product_info[0]['product_price'] ?? null;
            } else {
                $product->price = null;
            }
            unset($product->product_info);

            if ($product->productgallery && is_array($product->productgallery->images)) {
                $firstImage = $product->productgallery->images[0] ?? null;
                $product->image = $firstImage
                    ? asset('uploads/products/' . $firstImage)
                    : null;
            } else {
                $product->image = null;
            }
            unset($product->productgallery);

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
            ->with(['productgallery' => function ($query) {
                $query->select('id', 'product_id', 'images');
            }])
            ->select('id', 'name', 'rating', 'product_info');

        $products = $query->paginate(10);

        $products->getCollection()->transform(function ($product) {
            if (is_array($product->product_info) && count($product->product_info) > 0) {
                $product->price = $product->product_info[0]['product_price'] ?? null;
            } else {
                $product->price = null;
            }
            unset($product->product_info);

            if ($product->productgallery && is_array($product->productgallery->images)) {
                $firstImage = $product->productgallery->images[0] ?? null;
                $product->image = $firstImage
                    ? asset('uploads/products/' . $firstImage)
                    : null;
            } else {
                $product->image = null;
            }
            unset($product->productgallery);

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
            ->with(['productgallery' => function ($query) {
                $query->select('id', 'product_id', 'images');
            }])
            ->select('id', 'name', 'rating', 'product_info');

        $products = $query->paginate(10);

        $products->getCollection()->transform(function ($product) {
            if (is_array($product->product_info) && count($product->product_info) > 0) {
                $product->price = $product->product_info[0]['product_price'] ?? null;
            } else {
                $product->price = null;
            }
            unset($product->product_info);

            if ($product->productgallery && is_array($product->productgallery->images)) {
                $firstImage = $product->productgallery->images[0] ?? null;
                $product->image = $firstImage
                    ? asset('uploads/products/' . $firstImage)
                    : null;
            } else {
                $product->image = null;
            }
            unset($product->productgallery);

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
            ->with(['productgallery' => function ($query) {
                $query->select('id', 'product_id', 'images');
            }])
            ->select('id', 'name', 'rating', 'product_info');

        $products = $query->paginate(10);

        $products->getCollection()->transform(function ($product) {
            if (is_array($product->product_info) && count($product->product_info) > 0) {
                $product->price = $product->product_info[0]['product_price'] ?? null;
            } else {
                $product->price = null;
            }
            unset($product->product_info);

            if ($product->productgallery && is_array($product->productgallery->images)) {
                $firstImage = $product->productgallery->images[0] ?? null;
                $product->image = $firstImage
                    ? asset('uploads/products/' . $firstImage)
                    : null;
            } else {
                $product->image = null;
            }
            unset($product->productgallery);

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
                $product->price = $product->product_info[0]['product_price'] ?? null;
            } else {
                $product->price = null;
            }
            unset($product->product_info);

            if ($product->productgallery && is_array($product->productgallery->images)) {
                $firstImage = $product->productgallery->images[0] ?? null;
                $product->image = $firstImage
                    ? asset('uploads/products/' . $firstImage)
                    : null;
            } else {
                $product->image = null;
            }
            unset($product->productgallery);

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

        if ($product->productgallery && is_array($product->productgallery->images)) {
            $images = $product->productgallery->images ?? [];
            $product->images = !empty($images)
                ? array_map(function($image) {
                    return asset('uploads/products/' . $image);
                }, $images)
                : null;
        } else {
            $product->images = null;
        }
        unset($product->productgallery);

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
            ->paginate(10);

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

            if ($promotion->promotiongallery && is_array($promotion->promotiongallery->images)) {
                $images = $promotion->promotiongallery->images ?? [];
                $promotion->images = !empty($images)
                    ? array_map(function($image) {
                        return asset('uploads/promotions/' . $image);
                    }, $images)
                    : null;
            } else {
                $promotion->images = null;
            }
            unset($promotion->promotiongallery);

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
            ->with(['promotiongallery' => function ($query) {
                $query->select('id', 'promotion_id', 'images');
            }])
            ->first();

        if (!$promotion) {
            return response()->json(['error' => 'Promotion not found'], 404);
        }

        unset($promotion->created_at, $promotion->updated_at);

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

            if ($product->productgallery && is_array($product->productgallery->images)) {
                $images = $product->productgallery->images ?? [];
                $productData['images'] = !empty($images)
                    ? array_map(function($image) {
                        return asset('uploads/products/' . $image);
                    }, $images)
                    : null;
            } else {
                $productData['images'] = null;
            }

            return $productData;
        });
        unset($promotion->activeProducts);

        $promotion->brands = $promotion->activeBrands->map(function ($brand) {
            return [
                'id' => $brand->id,
                'name' => $brand->name,
                'images_url' => $brand->images_url ? asset('uploads/brands/' . $brand->images_url) : null // Safe URL generation
            ];
        });
        unset($promotion->activeBrands);

        if ($promotion->promotiongallery && is_array($promotion->promotiongallery->images)) {
            $promotion->images = array_map(function ($image) {
                return asset('uploads/promotions/' . $image);
            }, $promotion->promotiongallery->images);
        } else {
            $promotion->images = [];
        }
        unset($promotion->promotiongallery); // Remove promotiongallery from the response

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
                $order_detail->discount = $detail['discount'] ?? 0;
                $order_detail->discount_type = $detail['discount_type'] ?? null;
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

                // Update product_info with new quantity
                $product->product_info = array_map(function ($info) {
                    $info['product_qty'] = (string) $info['product_qty'];
                    return $info;
                }, $productInfoArray);

                // Increment count_product_sale
                $product->increment('count_product_sale', $detail['product_qty']);

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

    public function generateOTP(Request $request){

        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        try{
            $to = $request->phone;
            $otp = rand(100000,999999);
            $response = GlobalFunction::sendOTP($to,$otp);
            // if($response){
                $data['otp'] = $otp;
                return response()->json($data,200);
            // }
        }catch (\Exception $e) {
            $data = [
                'message'   => $e->getMessage()
            ];
            return response()->json($data,400);
        }
    }
}
