@extends('backends.layouts.admin')
@section('page_title', __('Role Management'))
@push('css')

@endpush
@section('contents')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h5 class="pb-1">{{ __('User role list') }}</h5>
                        @if (auth()->user()->can('role.create'))
                            <a class="btn bg-gradient-primary btn-modal add-new-button-right-side btn-xs" href="{{ route('admin.roles.create') }}">
                                <i class=" fa fa-plus-circle"></i>
                                {{ __('Add New') }}
                            </a>
                        @endif
                    </div>
                    <div class="card-body px-3 pt-0 pb-2">
                        @include('backends.role._table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')
    <script>
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
                    console.log(data);
                    $.ajax({
                        type: "post",
                        url: $(this).data('href'),
                        data: data,
                        // dataType: "json",
                        success: function (response) {
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
    </script>
@endpush
