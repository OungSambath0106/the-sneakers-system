<?php

namespace App\Http\Controllers\Backends;

use App\helpers\ImageManager;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BusinessSetting;
use App\Models\Translation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest('id')->get();
        return view('backends.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.brand._create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (is_null($request->name)) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name',
                    'Name field is required!'
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
            DB::beginTransaction();
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->created_by = auth()->user()->id;

            if ($request->hasFile('image')) {
                $brand->image = ImageManager::upload('uploads/brand/', $request->image);
            }

            $brand->save();
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Create successfully'),
            ];
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
        }

        return redirect()->back()->with($output);
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
        // dd($id);
        $brand = Brand::withoutGlobalScopes()->findOrFail($id);

        return view('backends.brand._edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (is_null($request->name)) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name',
                    'Name field is required!'
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
            DB::beginTransaction();

            $brand = Brand::findOrFail($id);
            $brand->name = $request->name;
            if ($request->hasFile('image')) {
                if ($brand->image && file_exists(public_path('uploads/brand/' . $brand->image))) {
                    unlink(public_path('uploads/brand/' . $brand->image));
                }

                $brand->image = ImageManager::update('uploads/brand/', null, $request->image);
            }
            $brand->save();
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Create successfully'),
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
        }

        return redirect()->back()->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $brand = Brand::findOrFail($id);
            $translation = Translation::where('translationable_type', 'App\Models\Brand')
                ->where('translationable_id', $brand->id);

            $translation->delete();
            $brand->delete();

            $brands = Brand::latest('id')->paginate(10);
            $view = view('backends.brand._table', compact('brands'))->render();

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

    public function deleteImage(Request $request)
    {
        $brand = Brand::find($request->brand_id);
        if ($brand && $brand->image) {
            $imagePath = public_path('uploads/brand/' . $brand->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $brand->image = null;
            $brand->save();

            return response()->json(['success' => true, 'message' => 'Image deleted']);
        }

        return response()->json(['success' => false, 'message' => 'User or image not found']);
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $brand = Brand::findOrFail($request->id);
            $brand->status = $brand->status == 1 ? 0 : 1;
            $brand->save();

            $output = ['status' => 1, 'msg' => __('Status updated')];

            DB::commit();
        } catch (Exception $e) {

            $output = ['status' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
