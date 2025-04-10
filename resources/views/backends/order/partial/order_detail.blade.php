@extends('backends.layouts.admin')
@section('page_title', __('Sales Report Detail'))

@section('contents')
    <style>
        .form-switch .form-check-input:after {
            top: 0px;
        }
        .carousel-control-prev, .carousel-control-next {
            width: unset !important;
            height: 2rem !important;
            align-self: center !important;
        }
        .carousel-control-prev {
            left: -50px !important;
        }
        .carousel-control-next {
            right: -50px !important;
        }
    </style>

    <div class="px-2 mx-1">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="mb-1">Order ID #{{ @$order->invoice_ref }}</h5>
                                <p class="text-muted mb-2">{{ @$order->created_at->format('d M, Y, h:i A') }}</p>
                            </div>
                            <div>
                                <a href="" class="btn bg-gradient-primary me-2">
                                    <i class="fas fa-map-marker-alt me-2"></i> Show locations on map
                                </a>
                                <a href="" class="btn bg-gradient-primary">
                                    <i class="fas fa-print me-2"></i> Print Invoice
                                </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 text-md-end">
                                <span class="text-muted pe-2">Status:</span>
                                @if ($order->order_status == 'pending')
                                    <span class="badge bg-gradient-warning">{{ @$order->order_status }}</span>
                                @elseif ($order->order_status == 'confirmed')
                                    <span class="badge bg-gradient-success">{{ @$order->order_status }}</span>
                                @elseif ($order->order_status == 'packaging')
                                    <span class="badge bg-gradient-info">{{ @$order->order_status }}</span>
                                @elseif ($order->order_status == 'out_for_delivery')
                                    <span class="badge bg-gradient-primary">{{ @$order->order_status }}</span>
                                @elseif ($order->order_status == 'delivered')
                                    <span class="badge bg-gradient-success">{{ @$order->order_status }}</span>
                                @elseif ($order->order_status == 'failed_to_deliver')
                                    <span class="badge bg-gradient-danger">{{ @$order->order_status }}</span>
                                @elseif ($order->order_status == 'cancelled')
                                    <span class="badge bg-gradient-danger">{{ @$order->order_status }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 text-md-end">
                                <span class="text-muted pe-2">Payment Method:</span>
                                {{ strtoupper(str_replace('_', ' ', @$order->payment_method)) }}
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12 text-md-end">
                                <span class="text-muted pe-2">Payment Status:</span>
                                @if ($order->payment_status == 'paid')
                                    <span class="text-success">{{ ucwords(@$order->payment_status) }}</span>
                                @else
                                    <span class="text-danger">{{ ucwords(@$order->payment_status) }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">SL</th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 px-2">Item Details</th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 px-2">Item Price</th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 px-2">Item Discount</th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 px-2">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($order->details ?? [] as $index => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($item->product->productgallery && count($item->product->productgallery->images) > 0)
                                                        @php
                                                            $firstImage = $item->product->productgallery->images[0];
                                                            $allImages = $item->product->productgallery->images;
                                                        @endphp

                                                        <img src="{{ file_exists(public_path('uploads/products/' . $firstImage)) ? asset('uploads/products/' . $firstImage) : asset('uploads/default.png') }}"
                                                            alt="Product Image" class="avatar avatar-xl me-3"
                                                            style="object-fit: contain; cursor: pointer;"
                                                            onclick="openGalleryModal({{ $item->product->id }})">

                                                        @include('backends.order.partial.modal_popup_image')
                                                    @else
                                                        <img src="{{ !empty($item->product->image[0]) && file_exists(public_path('uploads/products/' . $item->product->image[0])) ? asset('uploads/products/' . $item-> product->image[0]) : asset('uploads/default.png') }}"
                                                            alt="Product Image" class="avatar avatar-sm me-3">
                                                    @endif
                                                    <div>
                                                        <p class="mb-0 fw-bold"> {{ $item->product->name }} </p>
                                                        <p class="mb-0"> Qty: {{ $item->product_qty }} </p>
                                                        <p class="mb-0"> Size: {{ $item->product_size }}</p>
                                                        <p class="mb-0 text-muted">Unit price:
                                                            ${{ number_format($item->product_price, 2) }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> $ {{ number_format($item->product_price * $item->product_qty, 2) }} </td>
                                            <td>
                                                @if($item->discount_type == 'percent')
                                                    $ {{ number_format(($item->product_price * $item->discount / 100) * $item->product_qty, 2) }}
                                                @else
                                                    $ {{ number_format($item->discount * $item->product_qty, 2) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->discount_type == 'percent')
                                                    $ {{ number_format(($item->product_price * $item->discount / 100) * $item->product_qty, 2) }}
                                                @else
                                                    $ {{ number_format($item->product_price * $item->product_qty - $item->discount * $item->product_qty, 2) }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Item price</td>
                                            <td class="text-end">${{ number_format($order->order_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Item Discount</td>
                                            <td class="text-end">- ${{ number_format($order->discount_amount, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td class="text-end">${{ number_format($order->order_amount - $order->discount_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Delivery Fee</td>
                                            <td class="text-end">${{ number_format($order->delivery_fee, 2) }}</td>
                                        </tr>
                                        @php
                                            $total = $order->order_amount - $order->discount_amount + $order->delivery_fee;
                                        @endphp
                                        <tr class="fw-bold">
                                            <td>Total</td>
                                            <td class="text-end">${{ number_format($total, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h6 class="mb-3 text-center">Order & Shipping Info</h6>

                        <div class="mb-3">
                            <label class="form-label">Change Order Status</label>
                            <select class="form-select" id="orderStatus">
                                <option selected>Pending</option>
                                <option>Confirmed</option>
                                <option>Packaging</option>
                                <option>Out for delivery</option>
                                <option>Delivered</option>
                                <option>Failed to deliver</option>
                                <option>Cancelled</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center form-control">
                                <div class="left">
                                    <span>Payment Status</span>
                                </div>
                                <div class="right d-flex align-items-center">
                                    <span class="me-3">Unpaid</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="paymentStatusSwitch">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Shipping Method ( No Shipping Method Selected )</label>
                            <select class="form-select" id="shippingMethod">
                                <option selected>Choose Delivery Type</option>
                                <option> By self delivery method </option>
                                <option> By third party delivery service </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-user me-2"></i>
                                <h6 class="mb-0">Customer information</h6>
                            </div>

                            <div class="d-flex mb-2">
                                <img src="{{ asset('uploads/customers/' . $order->customer->image) ?? asset('uploads/man.png') }}"
                                    alt="Customer" class="avatar avatar-lg rounded-circle me-3" style="object-fit: cover;">
                                <div>
                                    <h6 class="mb-1">{{ @$order->customer->name }}</h6>
                                    <p class="mb-1 text-muted">{{ App\Models\Order::where('customer_id', @$order->customer->id)->count() }} Orders</p>
                                    <p class="mb-1">{{ @$order->customer->phone }}</p>
                                    <p class="mb-0">{{ @$order->customer->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-between mb-1">
                                <div class="d-flex">
                                    <i class="fas fa-map-marker-alt me-2 pt-1"></i>
                                    <h6 class="mb-0">Shipping address</h6>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary btn-modal" data-toggle="modal" data-target="#editAddressModal">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            <div>
                                <p class="mb-1"><strong>Name:</strong> {{ @$order->customer->name }} </p>
                                <p class="mb-1"><strong>Label:</strong> {{ @$order->address['label'] ?? '' }} </p>
                                <p class="mb-1"><strong>Contact:</strong> {{ @$order->address['phoneNumber'] ?? '' }} </p>
                                <p class="mb-1"><strong>Province:</strong>
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    {{ @$order->address['province'] ?? '' }}
                                </p>
                                <p class="mb-1"><strong>Street Line #1:</strong> {{ @$order->address['streetLine1'] ?? '' }}</p>
                                <p class="mb-1"><strong>Street Line #2:</strong> {{ @$order->address['streetLine2'] ?? '' }}</p>
                                <p class="mb-0"><strong>Note:</strong> {{ @$order->address['note'] ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <h5 class="modal-title text-center">{{ __('Edit Shipping Address') }}</h5>
                    <button type="button" class="close btn-close-modal position-absolute" style="top: 10px; right: 10px; border: none; background: none; font-size: 1.5rem;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <form action="#" enctype="multipart/form-data" class="submit-form mt-4" method="post">
                        <div class="row">
                            <!-- Label field -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group m-0">
                                    <button class="btn btn-sm btn-outline-primary mb-0 @if(@$order->address['label'] == 'Home') active @endif" value="Home">Home</button>
                                    <button class="btn btn-sm btn-outline-primary mb-0 @if(@$order->address['label'] == 'Work') active @endif" value="Work">Work</button>
                                    <button class="btn btn-sm btn-outline-primary mb-0 @if(@$order->address['label'] == 'Other') active @endif" value="Other">Other</button>
                                </div>
                            </div>

                            <!-- Phone Number field -->
                            <div class="col-md-6 mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phoneNumber" value="+855 855 964 828">
                            </div>

                            <!-- Province field -->
                            <div class="col-md-6 mb-3">
                                <label for="province" class="form-label">Province</label>
                                <input type="text" class="form-control" id="province" value="Siem Reap">
                            </div>

                            <!-- Street Line #1 field -->
                            <div class="col-md-6 mb-3">
                                <label for="streetLine1" class="form-label">Street Line #1</label>
                                <input type="text" class="form-control" id="streetLine1" value="Siem Reap">
                            </div>

                            <!-- Street Line #2 field -->
                            <div class="col-md-6 mb-3">
                                <label for="streetLine2" class="form-label">Street Line #2</label>
                                <input type="text" class="form-control" id="streetLine2" value="Siem Reap">
                            </div>

                            <!-- Note field -->
                            <div class="col-md-12 mb-3">
                                <label for="deliveryNote" class="form-label">Note</label>
                                <textarea class="form-control" id="deliveryNote" rows="2">Noted</textarea>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex justify-content-end gap-2 pt-3">
                        <button type="button" class="btn bg-gradient-danger btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn bg-gradient-primary btn-sm">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function openGalleryModal(productId) {
            let modal = new bootstrap.Modal(document.getElementById('imageGalleryModal-' + productId), {
                keyboard: true
            });
            modal.show();
        }
    </script>
@endpush
