@extends('backends.layouts.admin')
@section('page_title', __('Product'))
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
                        <div class="card-body">
                            <div class="d-flex col-12">
                                <div class="col-sm-6 filter tab-content" id="custom-content-below-tabContent">
                                    <select name="brand_id" id="brand_id" class="form-control select2">
                                        <option value="" class="form-control"
                                            {{ !request()->filled('brands') ? 'selected' : '' }}>
                                            {{ __('All Brand') }}
                                        </option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" class="form-control"
                                                {{ $brand->id == request('brand_id') ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h5 class="pb-1">{{ __('Products Table') }}</h5>
                            @if (auth()->user()->can('product.create'))
                                <a class="btn bg-gradient-primary add-new-button-right-side btn-xs" href="{{ route('admin.product.create') }}">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ __('Add New') }}
                                </a>
                            @endif
                        </div>
                        <div class="card-body px-3 pt-0 pb-2">
                            <div class="dataTableButtons-container d-flex mx-0 align-items-center pb-2">
                                <div id="dataTableButtons" class="dataTableButtons-left-side col-md-12" style="justify-content: space-between"></div>
                            </div>
                            @include('backends.product._table')
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
        $('.btn_add').click(function(e) {
            var tbody = $('.tbody');
            var numRows = tbody.find("tr").length;
            $.ajax({
                type: "get",
                url: window.location.href,
                data: {
                    "key": numRows
                },
                dataType: "json",
                success: function(response) {
                    $(tbody).append(response.tr);
                }
            });
        });

        $(document).on('click', '.btn-edit', function() {
            $("div.modal_form").load($(this).data('href'), function() {

                $(this).modal('show');

            });
        });

        $('.custom-file-input').change(function(e) {
            var reader = new FileReader();
            var preview = $(this).closest('.form-group').find('.preview img');
            console.log(preview);
            reader.onload = function(e) {
                preview.attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        $(document).on('click', '.btn-delete', function(e) {
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
                        success: function(response) {
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
        initializeStatusInput("{{ route('admin.product.update_status') }}");
    </script>
    <script>
        $(document).ready(function() {
            $('#brand_id').select2();
        });

        $(document).on('change', '#brand_id', function(e) {
            e.preventDefault();

            var brand_id = $('#brand_id').val();

            if ($.fn.DataTable.isDataTable('#bookingTable')) {
                $('#bookingTable').DataTable().destroy();
            }

            $.ajax({
                type: "GET",
                url: '{{ route('admin.product.index') }}',
                data: {
                    'brand_id': brand_id
                },
                dataType: "json",
                success: function(response) {
                    if (response.view) {
                        $('.table-wrapper').html(response.view);
                        initDataTable();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
@endpush
