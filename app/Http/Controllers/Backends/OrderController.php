<?php

namespace App\Http\Controllers\backends;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('sale_report.view')) {
            abort(403, 'Unauthorized action.');
        }

        $products = Product::all();
        $query = Order::with('customer', 'details.brand', 'details.product');

        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;

                case 'this_week':
                    $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;

                case 'this_month':
                    $query->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year);
                    break;

                case 'this_year':
                    $query->whereYear('created_at', Carbon::now()->year);
                    break;
            }
        }

        $orders = $query->latest('id')->paginate(10);

        return view('backends.order.index', compact('orders', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('sale_report.view')) {
            abort(403, 'Unauthorized action.');
        }

        $order = Order::with('customer', 'details.brand', 'details.product')->findOrFail($id);
        return view('backends.order.partial.order_detail', compact('order'));
    }

    public function editAddress()
    {
        if (!auth()->user()->can('sale_report.edit')) {
            abort(403, 'Unauthorized action.');
        }

        return view('backends.order.partial.modal_edit_address');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function invoicePdf($id)
    {
        if (!auth()->user()->can('sale_report.view')) {
            abort(403, 'Unauthorized action.');
        }

        $order = Order::with('customer', 'details.brand', 'details.product')->findOrFail($id);
        $invoiceRef = $order->invoice_ref ?? 'order-' . $id;

        return view('backends.order.partial.invoice_pdf', compact('order'));
    }
}
