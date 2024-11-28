<?php

namespace App\Http\Controllers\Backends;

use App\helpers\ImageManager;
use File;
use Exception;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::when($request->brand_id, function ($query) use ($request) {
                        $query->where('brand_id', $request->brand_id);
                    })
                    ->with('productgallery')
                    ->latest('id')
                    ->paginate(10);
        $brands = Brand::all();
        if ($request->ajax()) {
            $view = view('backends.product._table', compact('products', 'brands'))->render();
            return response()->json([
                'view' => $view
            ]);
        }

        return view('backends.product.index', compact('products', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $products = Product::with('brand')->get();
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.product.create', compact('products', 'brands', 'language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'brand_id' => 'required',
        ]);

        if (is_null($request->name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name',
                    'Name field is required!'
                );
            });
        }
        if (is_null($request->description[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'description',
                    'description field is required!'
                );
            });
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            // dd($request->all());
            DB::beginTransaction();

            $pro = new Product;
            $pro->name = $request->name[array_search('en', $request->lang)];
            $pro->description = $request->description[array_search('en', $request->lang)];
            $pro->brand_id = $request->brand_id;
            $pro->rating = $request->rating;
            $pro->created_by = auth()->user()->id;

            $products_info = [];
            if ($request->products_info) {
                foreach ($request->products_info['product_size'] as $key => $number) {
                    $item['product_size'] = $number;
                    $item['product_price'] = number_format((float)$request->products_info['product_price'][$key], 2, '.', '');
                    $item['product_qty'] = $request->products_info['product_qty'][$key];
                    array_push($products_info, $item);
                }
                $pro->product_info =$products_info;
            }

            $pro->save();

            $productid = $pro->id;
            $product_gallery = new ProductGallery();
            $product_gallery->product_id = $productid;
            if ($request->filled('image_names')) {
                $imageDetails = json_decode($request->input('image_names'), true);
                // $imageDetails = explode(' ', $request->input('image_names'));
                $product_data = [];
                foreach ($imageDetails as $detail) {
                    $directory = public_path('uploads/products');
                    if (!\File::exists($directory)) {
                        \File::makeDirectory($directory, 0777, true);
                    }
                    $moved_image = \File::move(public_path('uploads/temp/' . $detail), $directory . '/' . $detail);
                    $product_data[] = $detail;
                    $product_gallery->images = $product_data;
                    $product_gallery->save();
                }
            }

            $data = [];
            foreach ($request->lang as $index => $key) {
                if ($request->name[$index] && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Product',
                        'translationable_id' => $pro->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
                if ($request->description[$index] && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Product',
                        'translationable_id' => $pro->id,
                        'locale' => $key,
                        'key' => 'description',
                        'value' => $request->description[$index],
                    ));
                }
            }
            Translation::insert($data);

            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('Created successfully')
            ];
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return redirect()->route('admin.product.index')->with($output);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brands = Brand::all();
        $product = Product::withoutGlobalScopes()->with('translations', 'brand', 'productgallery')->findOrFail($id);

        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.product.edit', compact('product', 'brands', 'default_lang', 'language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'brand_id' => 'required',
        ]);

        // dd($validator);
        if (is_null($request->name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name',
                    'Name field is required!'
                );
            });
        }
        if (is_null($request->description[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'description',
                    'description field is required!'
                );
            });
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {

            // dd($request -> all());
            DB::beginTransaction();

            $product = Product::findOrFail($id);
            $product->name = $request->name[array_search('en', $request->lang)];
            $product->description = $request->description[array_search('en', $request->lang)];
            $product->brand_id = $request->brand_id;
            $product->rating = $request->rating;

            $products_info = [];
            if ($request->products_info) {
                foreach ($request->products_info['product_size'] as $key => $number) {
                    $item['product_size'] = $number;
                    $item['product_price'] = number_format((float)$request->products_info['product_price'][$key], 2, '.', '');
                    $item['product_qty'] = $request->products_info['product_qty'][$key];
                    array_push($products_info, $item);
                }
                $product->product_info =$products_info;
            }

            $product->save();

            $product_gallery = ProductGallery::where('product_id',$product->id)->first();
            $productgallery = $product_gallery->images??[];
            $imageNameToUpdate = $request->input('image_names');
            $newImage = json_decode($imageNameToUpdate, true);
            $product_data = [];
            if (is_array($newImage)) {
                foreach ($newImage as $detail) {
                    $directory = public_path('uploads/products');
                    if (!\File::exists($directory)) {
                        \File::makeDirectory($directory, 0777, true);
                    }
                    $moved_image = \File::move(public_path('uploads/temp/' . $detail), $directory . '/' . $detail);
                    $product_data[] = $detail;
                }
            }
            $merge = array_merge($productgallery, $product_data);
            $product_gallery->images = $merge;
            $product_gallery->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if ($request->name[$index] && $key != 'en') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\Product',
                            'translationable_id' => $product->id,
                            'locale' => $key,
                            'key' => 'name'
                        ],
                        ['value' => $request->name[$index]]
                    );
                }
            }
            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    Translation::updateOrInsert(
                        ['translationable_type' => 'App\Models\Product',
                            'translationable_id' => $product->id,
                            'locale' => $key,
                            'key' => 'description'],
                        ['value' => $request->description[$index]]
                    );
                }
            }
            Translation::insert($data);

            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('Created successfully')
            ];
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return redirect()->route('admin.product.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($id);
            $translation = Translation::where('translationable_type', 'App\Models\Product')
                ->where('translationable_id', $product->id);
            $translation->delete();
            $product->delete();

            $products = Product::latest('id')->paginate(10);
            $view = view('backends.product._table', compact('products'))->render();

            DB::commit();
            $output = [
                'status' => 1,
                'view' => $view,
                'msg' => __('Deleted successfully')
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $output = [
                'status' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return response()->json($output);
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($request->id);
            $product->status = $product->status == 1 ? 0 : 1;
            $product->save();

            $output = ['status' => 1, 'msg' => __('Status updated')];

            DB::commit();
        } catch (Exception $e) {

            $output = ['status' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }

    public function uploadNewGallery(Request $request)
    {
        try{
            \Log::info($request->all());
            DB::beginTransaction();
            $product_gallery = ProductGallery::where('product_id', $request->product_id)->first();
            if (!$product_gallery) {
                $product_gallery = new ProductGallery();
                $product_gallery->product_id = $request->product_id;
                $product_gallery->images = [];
            }
            $productgallery = $product_gallery->images??[];

            if ($request->filled('image_names')) {
                $imageDetails = $request->input('image_names');
                $product_data = [];
                foreach ($imageDetails as $detail) {
                    $directory = public_path('uploads/products');
                    if (!\File::exists($directory)) {
                        \File::makeDirectory($directory, 0777, true);
                    }
                    $moved_image = \File::move(public_path('uploads/temp/' . $detail), $directory . '/' . $detail);
                    $product_data[] = $detail;
                }
                $merged = array_merge($productgallery, $product_data);
                $product_gallery->images = $merged;
            }
            $product_gallery->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => __('Created successfully'),
            ]);
        } catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function deleteProductGallery(Request $request)
    {
        $productGallery = ProductGallery::where('product_id', $request->product_id)->first();
        if ($productGallery) {
            $imageNameToDelete = $request->input('name');
            $images = $productGallery->images;
            $imageExists = false;
            foreach ($images as $image) {
                if ($image === $imageNameToDelete) {
                    $imageExists = true;
                    break;
                }
            }
            if ($imageExists) {
                $newImages = array_filter($images, function ($image) use ($imageNameToDelete) {
                    return $image !== $imageNameToDelete;
                });
                $imagePath = public_path('uploads/products/' . $imageNameToDelete);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $productGallery->images = array_values($newImages);
                $productGallery->save();

                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false, 'message' => 'Image not found.']);
    }
}
