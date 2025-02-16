@extends('backends.master')
@section('page_title', __('Customer Management'))
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
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h3 class="card-title"> <i class="fa fa-filter" aria-hidden="true"></i>
                                    {{ __('Filter') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="tab-content" id="custom-content-below-tabContent">
                                <form method="GET" action="{{ route('admin.customer.index') }}">
                                    <div class="row">
                                        <div class=" col-9 d-flex">
                                            <div class="col-sm-6 filter">
                                                <label for="start_date">{{ __('Start Date') }}</label>
                                                <input type="date" id="start_date" class="form-control flatpickr" placeholder="Select Date"
                                                    name="start_date" value="{{ request('start_date') }}">
                                            </div>
                                            <div class="col-sm-6 filter">
                                                <label for="end_date">{{ __('End Date') }}</label>
                                                <input type="date" id="end_date" class="form-control flatpickr" placeholder="Select Date"
                                                    name="end_date" value="{{ request('end_date') }}">
                                            </div>
                                        </div>
                                        <div class=" col-3 mt-3">
                                            <div class="col-sm-12 mt-3">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-filter fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6;"></i>
                                                    {{ __('Filter') }}
                                                </button>
                                                <a href="javascript:void(0);" class="btn btn-danger" id="resetButton">
                                                    <i class="fas fa-sync-alt" id="resetIcon"></i>
                                                    {{ __('Reset') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <fieldset class="border fieldset-table px-3 mb-4">
                    <legend class="w-auto mb-0 pb-0 title-table text-uppercase">{{ __('Customer List') }}</legend>
                    <div class="card-header pt-2 px-0">
                        <div class="row mx-0 align-items-center" style="justify-content: space-between">
                            <div id="bookingTableButtons" class="col-md-10" style="justify-content: space-between"></div>
                            @if (auth()->user()->can('customer.create'))
                                <a class="btn btn-primary" href="{{ route('admin.customer.create') }}">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ __('Add New') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    @include('backends.customer._table')
                </fieldset>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center position-relative">
                {{-- <button type="button" class="close position-absolute" style="right: 3px; top: 0; color: red;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                <img id="modalImage" src="" alt="User Image" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal_form" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

@endsection
@push('js')
<script>
    document.getElementById('resetButton').addEventListener('click', function () {
        let icon = document.getElementById('resetIcon');
        icon.classList.add('fa-spin'); // Add animation

        window.location.href = "{{ route('admin.customer.index') }}";
    });
</script>
<script>
    function showImageModal(img) {
        document.getElementById('modalImage').src = img.src;
    }
</script>
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
                let row = $(this).closest('tr');
                let dataTable = $('#bookingTable').DataTable();

                var data = $(`.form-delete-${$(this).data('id')}`).serialize();
                $.ajax({
                    type: "post",
                    url: $(this).data('href'),
                    data: data,
                    success: function (response) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });

                        if (response.success == 1) {
                            dataTable.row(row).remove().draw(false); // Remove row from DataTable instantly
                            Toast.fire({
                                icon: 'success',
                                title: response.msg
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: response.msg
                            });
                        }
                    }
                });
            }
        });
    });

    //for update status
    initializeStatusInput("{{ route('admin.customer.update_status') }}");
</script>
@endpush
