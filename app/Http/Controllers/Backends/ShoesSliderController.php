<?php

namespace App\Http\Controllers\Backends;

use App\helpers\ImageManager;
use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\ShoesSlider;
use App\Models\Translation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShoesSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('shoes-slider.view')) {
            abort(403, 'Unauthorized action.');
        }

        $shoessliders = ShoesSlider::latest('id')->paginate(10);

        return view('backends.shoes-slider.index', compact('shoessliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.shoes-slider.create', compact('language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if (is_null($request->title[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'title',
                    'title field is required!'
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

            $shoesslider = new ShoesSlider();
            $shoesslider->title = $request->title[array_search('en', $request->lang)];

            if ($request->hasFile('image')) {
                $shoesslider->image = ImageManager::upload('uploads/shoes-slider/', $request->image);
            }

            $shoesslider->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if ($request->title[$index] && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\ShoesSlider',
                        'translationable_id' => $shoesslider->id,
                        'locale' => $key,
                        'key' => 'title',
                        'value' => $request->title[$index],
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
        return redirect()->route('admin.shoes-slider.index')->with($output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $shoesslider = ShoesSlider::orderByRaw('sort_order = 1 DESC')->orderBy('sort_order')->get();
        $shoesslider = ShoesSlider::withoutGlobalScopes()->with('translations')->findOrFail($id);
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.shoes-slider.edit', compact('shoesslider', 'language', 'default_lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if (is_null($request->title[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'title',
                    'title field is required!'
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

            $shoesslider =  ShoesSlider::findOrFail($id);
            $shoesslider->title = $request->title[array_search('en', $request->lang)];

            if ($request->hasFile('image')) {
                if ($shoesslider->image) {
                    $oldImagePath = public_path('uploads/shoes-slider/' . $shoesslider->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $image = $request->file('image');
                $imageName = now()->format('Y-m-d') . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/shoes-slider'), $imageName);
                $shoesslider->image = $imageName;
                $shoesslider->save();
            }
            $shoesslider->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->title[$index]) && $key != 'en') {
                    Translation::updateOrInsert(
                        ['translationable_type' => 'App\Models\ShoesSlider',
                            'translationable_id' => $shoesslider->id,
                            'locale' => $key,
                            'key' => 'title'],
                        ['value' => $request->title[$index]]
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
        return redirect()->route('admin.shoes-slider.index')->with($output);
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $shoesslider = ShoesSlider::findOrFail($request->id);
            $shoesslider->status = $shoesslider->status == 1 ? 0 : 1;
            $shoesslider->save();

            $output = ['status' => 1, 'msg' => __('Status updated')];

            DB::commit();
        } catch (Exception $e) {

            $output = ['status' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $shoesslider = ShoesSlider::findOrFail($id);
            $translation = Translation::where('translationable_type', 'App\Models\ShoesSlider')
                ->where('translationable_id', $shoesslider->id);
            $translation->delete();
            $shoesslider->delete();

            $shoessliders = ShoesSlider::latest('id')->paginate(10);
            $view = view('backends.shoes-slider._table', compact('shoessliders'))->render();

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
}
