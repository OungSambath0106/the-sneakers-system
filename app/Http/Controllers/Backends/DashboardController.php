<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::get();
        $customers = Customer::take(6)->latest('id')->get();
        $totalCustomers = Customer::count();
        $brands = Brand::get();
        $products = Product::get();
        $count_pro_sale = Product::select('*')
            ->orderByRaw('CAST(count_product_sale AS UNSIGNED) DESC')
            ->take(3)
            ->get()
            ->map(function ($product) {
                $productInfo = $product->product_info;

                if (is_array($productInfo)) {
                    $totalQty = array_sum(array_column($productInfo, 'product_qty'));
                    $product->total_qty = $totalQty;
                }

                return $product;
            });
        return view('backends.index', compact('users', 'customers', 'totalCustomers', 'brands', 'products', 'count_pro_sale'));
    }
}
