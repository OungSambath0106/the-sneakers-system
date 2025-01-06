@extends('backends.master')
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
        .card .card-head-row, .card-light .card-head-row {
            display: flex;
            align-items: center;
        }
        .card .card-head-row .card-tools, .card-light .card-head-row .card-tools {
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
        .card-list .item-list .info-user .username, .card-list .item-list .info-user a.username {
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
        .table > tbody > tr > td, .table > tbody > tr > th {
            padding: 16px 24px !important;
        }
        .table td, .table th {
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
    <section class="px-3">
        <div class="py-3">
            {{-- <h2>Wellcome to , {{ session()->get('company_name') }}</h2> --}}
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div
                    class="small-box bg-white d-flex p-3 justify-content-between align-items-center dashboard_summary_box dashboard_shadow">
                    <div class="rounded-circle bg-light p-2" style="height: 70px; width: 70px;">
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
                    <div class="rounded-circle bg-light p-2" style="height: 70px; width: 70px;">
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
                    <div class="rounded-circle bg-light p-2" style="height: 70px; width: 70px;">
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
                    <div class="rounded-circle bg-light p-2" style="height: 70px; width: 70px;">
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
                                                        alt="Product Image" class="carousel-image avatar-img rounded-circle"
                                                        style="display: {{ $index == 0 ? 'block' : 'none' }};">
                                                @endforeach
                                            </div>
                                        @else
                                            <img src="{{ !empty($pro_sale->image[0]) && file_exists(public_path('uploads/products/' . $pro_sale->image[0])) ? asset('uploads/products/' . $pro_sale->images[0]) : asset('uploads/default.png') }}"
                                                alt="Product Image" class="avatar-img rounded-circle">
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
    </section>
@endsection
@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const carousels = document.querySelectorAll(".custom-carousel");

        carousels.forEach(carousel => {
            const images = carousel.querySelectorAll(".carousel-image");
            let currentIndex = 0;

            carousel.addEventListener("click", function () {
                images[currentIndex].style.display = "none";

                currentIndex = (currentIndex + 1) % images.length;

                images[currentIndex].style.display = "block";
            });
        });
    });
</script>
@endpush
