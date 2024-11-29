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
        $customers = Customer::take(8)->get();
        $totalCustomers = Customer::count();
        $brands = Brand::get();
        $products = Product::get();

        return view('backends.index', compact('users', 'customers', 'totalCustomers', 'brands', 'products'));
    }
}
