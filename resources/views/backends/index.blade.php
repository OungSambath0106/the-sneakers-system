@extends('backends.layouts.admin')
@section('page_title')
    Admin Dashboard
@endsection
@push('css')
    <style>
        .small-box p {
            font-size: 0.9rem;
        }

        .dashboard_event_table tr th {
            background: #d4e0ff !important;
            color: #3d95d0 !important;
            text-transform: uppercase;
        }

        table td {
            height: 75.5px
        }

        .card .card-head-row,
        .card-light .card-head-row {
            display: flex;
            align-items: center;
        }

        .card .card-head-row .card-tools,
        .card-light .card-head-row .card-tools {
            margin-left: auto;
            float: right;
            padding-left: 15px;
        }

        .card-list .item-list {
            display: flex;
            flex-direction: row;
            padding: 10px 0;
            align-items: center;
        }

        .avatar {
            width: 3.2rem;
            height: 3.2rem;
            position: relative;
            display: inline-block;
        }

        .avatar-product {
            width: 4.5rem;
            height: 4.5rem;
            position: relative;
            display: inline-block;
            align-content: center;
        }

        .avatar-img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
        }

        .card-list .item-list .info-user {
            flex: 1;
            padding-left: 1rem;
        }

        .card-list .item-list .info-user .username,
        .card-list .item-list .info-user a.username {
            font-size: 14px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .card-list .item-list .info-user .status {
            font-size: 12px;
            color: #7d7b7b;
        }

        .btn-danger {
            color: #F25961 !important;
            background: none !important;
            border: none;
        }

        /* .btn-danger:hover {
                background: none;
            }
            .btn-danger:hover {
                background: none;
            } */
        .avatar .avatar-title {
            font-size: 18px;
        }

        .avatar .border {
            border-width: 3px !important;
        }

        .avatar-title {
            width: 100%;
            height: 100%;
            background-color: #6861CE;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .table thead th {
            font-size: .85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 12px 24px !important;
            border-bottom-width: 1px;
            font-weight: 600;
        }

        .table>tbody>tr>td,
        .table>tbody>tr>th {
            padding: 16px 24px !important;
        }

        .table td,
        .table th {
            font-size: 0.9rem;
            border-bottom: 1px solid;
            border-color: #ebedf2 !important;
            vertical-align: middle !important;
        }

        .btn-icon.btn-sm {
            height: 1.7rem;
            min-width: 1.8rem;
            width: 1.7rem;
        }

        .btn-round {
            border-radius: 100px !important;
        }

        .dashboard_summary_box {
            border-radius: 1rem;
        }
    </style>
@endpush
@section('contents')
    {{-- <section class="px-3">
        <div class="py-3">
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div
                    class="small-box bg-white d-flex p-3 justify-content-between align-items-center dashboard_summary_box dashboard_shadow">
                    <div class="bg-light p-2" style="height: 70px; width: 70px; border-radius: 50%;">
                        <div style="padding:7px;">
                            <svg width="44px" height="44px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="9" cy="6" r="4" stroke="#3d95d0" stroke-width="1.5" />
                                <path d="M15 9C16.6569 9 18 7.65685 18 6C18 4.34315 16.6569 3 15 3" stroke="#3d95d0"
                                    stroke-width="1.5" stroke-linecap="round" />
                                <path
                                    d="M5.88915 20.5843C6.82627 20.8504 7.88256 21 9 21C12.866 21 16 19.2091 16 17C16 14.7909 12.866 13 9 13C5.13401 13 2 14.7909 2 17C2 17.3453 2.07657 17.6804 2.22053 18"
                                    stroke="#3d95d0" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M18 14C19.7542 14.3847 21 15.3589 21 16.5C21 17.5293 19.9863 18.4229 18.5 18.8704"
                                    stroke="#3d95d0" stroke-width="1.5" stroke-linecap="round" />
                            </svg>

                        </div>
                    </div>
                    <div class="inner text-right">
                        <h4>{{ $users->count() }}</h4>
                        <p class="m-0 text-uppercase">{{ __('Total User') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div
                    class="small-box bg-white d-flex p-3 justify-content-between align-items-center dashboard_summary_box dashboard_shadow">
                    <div class="bg-light p-2" style="height: 70px; width: 70px; border-radius: 50%;">
                        <div style="padding:4px;">
                            @include('svgs.brand')
                        </div>
                    </div>
                    <div class="inner text-right">
                        <h4>{{ $brands->count() }}</h4>
                        <p class="m-0 text-uppercase">{{ __('Total Brands') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div
                    class="small-box bg-white d-flex p-3 justify-content-between align-items-center dashboard_summary_box dashboard_shadow">
                    <div class="bg-light p-2" style="height: 70px; width: 70px; border-radius: 50%;">
                        <div style="padding:6px;">
                            @include('svgs.product')
                        </div>
                    </div>
                    <div class="inner text-right">
                        <h4>{{ $products->count() }}</h4>
                        <p class="m-0 text-uppercase">{{ __('Total Products') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div
                    class="small-box bg-white d-flex p-3 justify-content-between align-items-center dashboard_summary_box dashboard_shadow">
                    <div class="bg-light p-2" style="height: 70px; width: 70px; border-radius: 50%;">
                        <div style="padding:10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 80" x="0px" y="0px"
                                style="fill:#3d95d0;">
                                <g data-name="Order-Shopping Cart-Wishlist-Paper-Commerce">
                                    <path
                                        d="M49,2H16a6,6,0,0,0-1,11.91V29h2V14H49a1,1,0,0,0,0-2,4,4,0,1,1,4-4V56a4,4,0,1,1-4-4,1,1,0,0,0,0-2H17V43H15v7.09A6,6,0,0,0,16,62H49a6,6,0,0,0,6-6V8A6,6,0,0,0,49,2ZM44.53,12H16a4,4,0,0,1,0-8H44.54a5.979,5.979,0,0,0-.01,8ZM16,60a4,4,0,0,1,0-8H44.53a5.979,5.979,0,0,0,.01,8Z" />
                                    <path
                                        d="M46,39H31V37H46a1.01,1.01,0,0,0,1-.92l1-12a1.013,1.013,0,0,0-.26-.76A1.029,1.029,0,0,0,47,23H30.41l-1.7-1.71A1.033,1.033,0,0,0,28,21H26.82A3.01,3.01,0,0,0,24,19H22a3,3,0,0,0,0,6h2a3.01,3.01,0,0,0,2.82-2h.77L29,24.41V40a1,1,0,0,0,1,1h1.18a3,3,0,1,0,5.64,0h2.36a3,3,0,1,0,5.64,0H46a1,1,0,0,1,1,1h2A3.009,3.009,0,0,0,46,39ZM43,25h2.91l-.16,2H43Zm0,4h2.58l-.17,2H43Zm0,4h2.25l-.17,2H43Zm-4-8h2v2H39Zm0,4h2v2H39Zm0,4h2v2H39Zm-4-8h2v2H35Zm0,4h2v2H35Zm0,4h2v2H35Zm-4-8h2v2H31Zm0,4h2v2H31Zm0,4h2v2H31ZM24,23H22a1,1,0,0,1,0-2h2a1,1,0,0,1,0,2ZM34,43a1,1,0,1,1,1-1A1,1,0,0,1,34,43Zm8,0a1,1,0,1,1,1-1A1,1,0,0,1,42,43Z" />
                                    <rect x="5" y="39" width="2" height="2" />
                                    <rect x="9" y="39" width="4" height="2" />
                                    <rect x="15" y="39" width="12" height="2" />
                                    <rect x="12" y="35" width="10" height="2" />
                                    <rect x="17" y="31" width="8" height="2" />
                                    <rect x="13" y="31" width="2" height="2" />
                                    <rect x="8" y="35" width="2" height="2" />
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="inner text-right">
                        <h4>$ </h4>
                        <p class="m-0 text-uppercase">{{ __('Total Earning') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-body">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">{{ __('Best Selling Products') }}</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-list py-4">
                            @foreach ($count_pro_sale as $pro_sale)
                                <div class="item-list">
                                    <div class="avatar-product">
                                        @if ($pro_sale->productgallery && count($pro_sale->productgallery->images) > 0)
                                            <div class="custom-carousel carousel-{{ $pro_sale->id }}" data-product-id="{{ $pro_sale->id }}" data-current-index="0">
                                                @foreach ($pro_sale->productgallery->images as $index => $image)
                                                    <img src="{{ file_exists(public_path('uploads/products/' . $image)) ? asset('uploads/products/' . $image) : asset('uploads/default.png') }}"
                                                        alt="Product Image" class="carousel-image avatar-img"
                                                        style="display: {{ $index == 0 ? 'block' : 'none' }};">
                                                @endforeach
                                            </div>
                                        @else
                                            <img src="{{ !empty($pro_sale->image[0]) && file_exists(public_path('uploads/products/' . $pro_sale->image[0])) ? asset('uploads/products/' . $pro_sale->images[0]) : asset('uploads/default.png') }}"
                                                alt="Product Image" class="avatar-img">
                                        @endif
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username"> <a class="text-dark" href="{{route('admin.product.edit', $pro_sale->id)}}"> {{ $pro_sale->name }} </a> </div>
                                        <div class="status">{{ $pro_sale->total_qty }} {{ __('in stock') }}, {{$pro_sale->count_product_sale}} {{ __('sold') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card card-round">
                    <div class="card-body">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">{{ __('New Customers') }}</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-list py-4">
                            @foreach ($customers as $customer)
                                <div class="item-list">
                                    <div class="avatar">
                                        @if ($customer->image && file_exists(public_path('uploads/customers/' . $customer->image)))
                                        <img src="{{ asset('uploads/customers/'. $customer->image) }}" alt="..." class="avatar-img rounded-circle">
                                        @else
                                            <span class="avatar-title rounded-circle border border-white">
                                                {{ strtoupper(substr($customer->first_name, 0, 1)) }}{{ strtoupper(substr($customer->last_name, 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username"> <a class="text-dark" href="{{route('admin.customer.edit', $customer->id)}}"> {{ $customer->first_name }} {{ $customer->last_name }} </a> </div>
                                        <div class="status">{{ $customer->email }}</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <span style="color: rgb(139, 139, 139)">{{ __('Total') }} {{ $totalCustomers }} {{ __('Customers') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">{{ __('Transaction History') }}</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('Payment Number') }}</th>
                                        <th scope="col" class="text-end">{{ __('Date & Time') }}</th>
                                        <th scope="col" class="text-end">{{ __('Amount') }}</th>
                                        <th scope="col" class="text-end">{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">{{ __('Total Users') }}</p>
                                <h5 class="font-weight-bolder">
                                    {{ $users->count() }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+3%</span>
                                    since last week
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">{{ __('Total Brands') }}</p>
                                <h5 class="font-weight-bolder">
                                    {{ $brands->count() }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                    since last quarter
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">{{ __('Total Products') }}</p>
                                <h5 class="font-weight-bolder">
                                    {{ $products->count() }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+55%</span>
                                    since yesterday
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Sales</p>
                                <h5 class="font-weight-bolder">
                                    $103,430
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+5%</span> than last
                                    month
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">{{ __('Best Selling Products') }}</h6>
                </div>
                <div class="card-body p-3">
                    @foreach ($count_pro_sale as $pro_sale)
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        @if ($pro_sale->productgallery && count($pro_sale->productgallery->images) > 0)
                                            <div class="custom-carousel carousel-{{ $pro_sale->id }}"
                                                data-product-id="{{ $pro_sale->id }}" data-current-index="0">
                                                @foreach ($pro_sale->productgallery->images as $index => $image)
                                                    <img src="{{ file_exists(public_path('uploads/products/' . $image)) ? asset('uploads/products/' . $image) : asset('uploads/default.png') }}"
                                                        alt="Product Image" class="carousel-image avatar-img"
                                                        style="display: {{ $index == 0 ? 'block' : 'none' }};">
                                                @endforeach
                                            </div>
                                        @else
                                            <img src="{{ !empty($pro_sale->image[0]) && file_exists(public_path('uploads/products/' . $pro_sale->image[0])) ? asset('uploads/products/' . $pro_sale->images[0]) : asset('uploads/default.png') }}"
                                                alt="Product Image" class="avatar-img">
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm"> <a href="{{ route('admin.product.index') }}">
                                                {{ $pro_sale->name }} </a> </h6>
                                        <span class="text-xs">{{ $pro_sale->total_qty }} {{ __('in stock') }}, <span
                                                class="font-weight-bold">{{ $pro_sale->count_product_sale }}
                                                {{ __('sold') }}</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('admin.product.index') }}"
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                        <i class="ni ni-bold-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card card-carousel overflow-hidden h-100 p-0">
                <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner border-radius-lg h-100">
                        @foreach ($shoesSliders as $index => $shoesSlider)
                            <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}"
                                style="background-image: url('{{ asset('uploads/shoes-slider/' . $shoesSlider->image) }}'); background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <h5 class="text-white mb-1">{{ $shoesSlider->title }}</h5>
                                    <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev w-5 me-3" type="button"
                        data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next w-5 me-3" type="button"
                        data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-5 mb-sm-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">{{ __('New Customers') }}</h6>
                </div>
                <div class="card-body p-3">
                    @foreach ($customers as $customer)
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="me-3 text-center avatar">
                                        @if ($customer->image && file_exists(public_path('uploads/customers/' . $customer->image)))
                                            <img src="{{ asset('uploads/customers/' . $customer->image) }}" alt="..."
                                                class="avatar-img rounded-circle">
                                        @else
                                            <span class="avatar-title rounded-circle border border-white">
                                                {{ strtoupper(substr($customer->first_name, 0, 1)) }}{{ strtoupper(substr($customer->last_name, 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm"> <a
                                                href="{{ route('admin.customer.edit', $customer->id) }}">
                                                {{ $customer->first_name }} {{ $customer->last_name }} </a> </h6>
                                        <span class="text-xs">{{ $customer->email }}</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="d-flex">
                                        <a href="{{ route('admin.customer.index') }}"
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                            <i class="ni ni-bold-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                    <span class="text-sm">{{ __('Total') }} {{ $totalCustomers }} {{ __('Customers') }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>{{ __('Transaction History') }}</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xs font-weight-bolder opacity-7"> {{ __('Payment Ref') }} </th>
                                    <th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2"> {{ __('Amount') }} </th>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder opacity-7"> {{ __('Status') }} </th>
                                    <th class="opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="py-1">
                                            <div class="d-flex flex-column">
                                                <a href="#" class="mb-1 text-dark font-weight-bold text-sm">December, 15, 2024</a>
                                                <span class="text-xs">#TSK-415646</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">$ 180.00</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Paid</span>
                                        {{-- <span class="badge badge-sm bg-gradient-secondary">Unpaid</span> --}}
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const carousels = document.querySelectorAll(".custom-carousel");

            carousels.forEach(carousel => {
                const images = carousel.querySelectorAll(".carousel-image");
                let currentIndex = 0;

                carousel.addEventListener("click", function() {
                    images[currentIndex].style.display = "none";

                    currentIndex = (currentIndex + 1) % images.length;

                    images[currentIndex].style.display = "block";
                });
            });
        });
    </script>
@endpush
