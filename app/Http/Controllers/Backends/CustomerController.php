<?php

namespace App\Http\Controllers\Backends;

use App\helpers\ImageManager;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('customer.view')) {
            abort(403, 'Unauthorized action.');
        }
        $customers = Customer::when($request->start_date && $request->end_date, function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date);
        })
            ->latest('id')
            ->paginate(10);

        return view('backends.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('customer.create')) {
            abort(403, 'Unauthorized action.');
        }

        return view('backends.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('customer.create')) {
            abort(403, 'Unauthorized action.');
        }
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            // dd($request->all());
            DB::beginTransaction();

            $customer = new Customer();
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->phone = $request->phone;
            $customer->gender = $request->gender;
            $customer->email = $request->email;
            $customer->password = Hash::make($request['password']);

            if ($request->filled('image_names')) {
                $customer->image = $request->image_names;
                $directory = public_path('uploads/customers');
                if (!\File::exists($directory)) {
                    \File::makeDirectory($directory, 0777, true);
                }

                $image = \File::move(public_path('uploads/temp/' . $request->image_names), public_path('uploads/customers/'. $request->image_names));

            }

            $customer->save();
            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('Created successfully')
            ];
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return redirect()->route('admin.customer.index')->with($output);
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
        if (!auth()->user()->can('customer.edit')) {
            abort(403, 'Unauthorized action.');
        }
        $customer = Customer::findOrFail($id);
        return view('backends.customer.edit', compact('customer'));
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
        if (!auth()->user()->can('customer.edit')) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:customers,email,' . $id,
            'password' => 'nullable|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $customer = Customer::findOrFail($id);
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->phone = $request->phone;
            $customer->gender = $request->gender;
            $customer->email = $request->email;

            if ($request->password) {
                $customer->password = Hash::make($request['password']);
            }

            if ($request->filled('image_names')) {
                $customer->image = $request->image_names;
                $directory = public_path('uploads/customers');
                if (!\File::exists($directory)) {
                    \File::makeDirectory($directory, 0777, true);
                }

                $image = \File::move(public_path('uploads/temp/' . $request->image_names), public_path('uploads/customers/'. $request->image_names));

            }

            $customer->save();

            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('Updated successfully')
            ];
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return redirect()->route('admin.customer.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('customer.delete')) {
            abort(403, 'Unauthorized action.');
        }
        try {
            DB::beginTransaction();
            $customer = Customer::findOrFail($id);
            if ($customer->image) {
                ImageManager::delete(public_path('uploads/customers/' . $customer->image));
            }
            $customer->delete();
            $customers = Customer::latest('id')->paginate(10);
            $view = view('backends.customer._table', compact('customers'))->render();

            DB::commit();
            $output = [
                'status' => 1,
                'view'  => $view,
                'msg' => __('Customer Deleted successfully')
            ];
        } catch (Exception $e) {
            DB::rollBack();

            $output = [
                'status' => 0,
                'msg' => __('Something when wrong')
            ];
        }

        return response()->json($output);
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $customer = Customer::findOrFail($request->id);
            $customer->status = $customer->status == 1 ? 0 : 1;
            $customer->save();

            $output = ['status' => 1, 'msg' => __('Status updated')];

            DB::commit();
        } catch (Exception $e) {
            dd($e);
            $output = ['status' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
