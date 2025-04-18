@extends('backends.layouts.admin')
@section('page_title', __('Sales Report'))
@push('css')
    <style>
        .preview {
            margin-block: 12px;
            text-align: center;
        }
        .tab-pane {
            margin-top: 20px
        }
        .ckbx-style-9 input[type=checkbox]:checked+label:before {
            background: #3d95d0 !important;
            box-shadow: inset 0 1px 1px rgba(84, 116, 152, 0.5) !important;
        }
    </style>
@endpush
@section('contents')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h5 class="pb-1">
                            <i class="fa fa-filter" aria-hidden="true"></i>
                            {{ __('Filter') }}
                        </h5>
                    </div>
                    <div class="card-body pt-1">
                        <form method="GET" action="{{ route('admin.order.index') }}">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 filter">
                                    <label for="product_id">{{ __('Product') }}</label>
                                    <select name="product_id" id="product_id" class="form-control select2">
                                        <option value="all" class="form-control" {{ !request()->filled('products') ? 'selected' : '' }}>
                                            {{ __('All Products') }}
                                        </option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" class="form-control" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 filter">
                                    <label for="payment_method">{{ __('Payment Method') }}</label>
                                    <select name="payment_method" id="payment_method" class="form-control select2">
                                        <option value="all" class="form-control" {{ !request()->filled('payment_method') ? 'selected' : '' }}>
                                            {{ __('All Payment') }}
                                        </option>
                                        <option value="cash_on_delivery" {{ request('payment_method') == 'cash_on_delivery' ? 'selected' : '' }}>
                                            {{ __('Cash On Delivery') }}
                                        </option>
                                        <option value="ABA" {{ request('payment_method') == 'ABA' ? 'selected' : '' }}>
                                            {{ __('ABA') }}
                                        </option>
                                        <option value="AC" {{ request('payment_method') == 'AC' ? 'selected' : '' }}>
                                            {{ __('ACLECDA') }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 filter">
                                    <label for="filter">{{ __('Filter Date') }}</label>
                                    <select name="filter" onchange="this.form.submit()" class="form-control select2">
                                        <option value="all" {{ request('filter') == '' ? 'selected' : '' }}>All Orders</option>
                                        <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Today</option>
                                        <option value="this_week" {{ request('filter') == 'this_week' ? 'selected' : '' }}>This Week</option>
                                        <option value="this_month" {{ request('filter') == 'this_month' ? 'selected' : '' }}>This Month</option>
                                        <option value="this_year" {{ request('filter') == 'this_year' ? 'selected' : '' }}>This Year</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h5 class="pb-1">{{ __('Sales Report') }}</h5>
                    </div>
                    <div class="card-body px-3 pt-0 pb-2">
                        <div class="dataTableButtons-container d-flex mx-0 align-items-center pb-2">
                            <div id="dataTableButtons" class="dataTableButtons-left-side col-md-12" style="justify-content: space-between"></div>
                        </div>
                        @include('backends.order._table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade modal_form" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

@endsection
@push('js')
<script>
    $('.btn_add').click(function (e) {
        var tbody = $('.tbody');
        var numRows = tbody.find("tr").length;
        $.ajax({
            type: "get",
            url: window.location.href,
            data: {
                "key" : numRows
            },
            dataType: "json",
            success: function (response) {
                $(tbody).append(response.tr);
            }
        });
    });

    $(document).on('click', '.btn-edit', function(){
        $("div.modal_form").load($(this).data('href'), function(){

            $(this).modal('show');

        });
    });

    $('.custom-file-input').change(function (e) {
        var reader = new FileReader();
        var preview = $(this).closest('.form-group').find('.preview img');
        console.log(preview);
        reader.onload = function(e) {
            preview.attr('src', e.target.result).show();
        }
        reader.readAsDataURL(this.files[0]);
    });

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();

        const Confirmation = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        Confirmation.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                console.log(`.form-delete-${$(this).data('id')}`);
                var data = $(`.form-delete-${$(this).data('id')}`).serialize();
                // console.log(data);
                $.ajax({
                    type: "post",
                    url: $(this).data('href'),
                    data: data,
                    // dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if (response.status == 1) {
                            $('.table-wrapper').replaceWith(response.view);
                            toastr.success(response.msg);
                        } else {
                            toastr.error(response.msg)

                        }
                    }
                });
            }
        });
    });

    //for update status
    // initializeStatusInput("{{ route('admin.shoes-slider.update_status') }}");
</script>
@endpush
