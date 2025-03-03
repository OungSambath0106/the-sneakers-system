@extends('backends.layouts.admin')
@section('page_title', __('Add New Product'))
@section('contents')
    <style>
        .dark-version .table tbody tr td {
            border-width: 1px !important;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="name" class="required_label">{{ __('Name') }}</label>
                                                <input type="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                                    name="name" placeholder="{{ __('Enter Name') }}" value="">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="description" class="required_label">{{ __('Description') }}</label>
                                                <textarea type="text" id="description" class="form-control @error('description') is-invalid @enderror"
                                                    name="description" placeholder="{{ __('Enter Description') }}" value=""></textarea>
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group d-flex col-md-12 mb-0">
                                                <div class="form-group col-md-2">
                                                    <label class="switch" for="new-arrival">
                                                        {{ __('New Arrival') }}
                                                        <input type="checkbox" class="status" id="new-arrival" value="0" name="new-arrival">
                                                        <div class="slider mt-2">
                                                            <div class="circle">
                                                                <svg class="cross" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 365.696 365.696" y="0" x="0" height="6" width="6" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                    <g>
                                                                        <path data-original="#000000" fill="currentColor" d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0"></path>
                                                                    </g>
                                                                </svg>
                                                                <svg class="checkmark" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 24 24" y="0" x="0" height="10" width="10" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                    <g>
                                                                        <path class="" data-original="#000000" fill="currentColor" d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"></path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="required_lable switch" for="recommended">
                                                        {{ __('Recommended') }}
                                                        <input type="checkbox" class="status" id="recommended" value="0" name="recommended">
                                                        <div class="slider mt-2">
                                                            <div class="circle">
                                                                <svg class="cross" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 365.696 365.696" y="0" x="0" height="6" width="6" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                    <g>
                                                                        <path data-original="#000000" fill="currentColor" d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0"></path>
                                                                    </g>
                                                                </svg>
                                                                <svg class="checkmark" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 24 24" y="0" x="0" height="10" width="10" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                    <g>
                                                                        <path class="" data-original="#000000" fill="currentColor" d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"></path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="required_lable switch" for="popular">
                                                        {{ __('Most Popular') }}
                                                        <input type="checkbox" class="status" id="popular" value="0" name="popular">
                                                        <div class="slider mt-2">
                                                            <div class="circle">
                                                                <svg class="cross" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 365.696 365.696" y="0" x="0" height="6" width="6" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                    <g>
                                                                        <path data-original="#000000" fill="currentColor" d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0"></path>
                                                                    </g>
                                                                </svg>
                                                                <svg class="checkmark" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 24 24" y="0" x="0" height="10" width="10" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                    <g>
                                                                        <path class="" data-original="#000000" fill="currentColor" d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"></path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label class="required_label" for="brand">{{ __('Brand') }}</label>
                                                <select name="brand_id" id="brand"
                                                    class="form-control select2 @error('brand_id') is-invalid @enderror">
                                                    <option value="">{{ __('Select Brand') }}</option>
                                                    @foreach ($brands as $item)
                                                        <option value="{{ $item -> id }}">{{ $item -> name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('brand')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>

                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="required_label" for="rating">{{ __('Star Rating') }}</label>
                                                <select name="rating" id="rating" class="form-control select2 @error('rating') is-invalid @enderror">
                                                    <option value="">{{ __('Select Rating') }}</option>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }} @if($i < 2){{ __('Star') }}@else{{ __('Stars') }}@endif</option>
                                                    @endfor
                                                </select>
                                                @error('rating')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div class="form-group mb-0">
                                                    <label for="exampleInputFile">{{ __('Product Info') }}</label>
                                                    <table class="table table-bordered table-striped table-hover rowfy mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th class="col-4">{{ __('Size') }}</th>
                                                                <th class="col-4">{{ __('Price') }}</th>
                                                                <th class="col-4">{{ __('Quantity') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input type="number" class="form-control" min="0" oninput="validatePriceInput(this)" onkeydown="preventMinus(event)"
                                                                        name="products_info[product_size][]">
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">$</span>
                                                                        </div>
                                                                        <input type="number" class="form-control" min="0" oninput="validatePriceInput(this)" onkeydown="preventMinus(event)"
                                                                            name="products_info[product_price][]">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control" min="0" oninput="validatePriceInput(this)" onkeydown="preventMinus(event)"
                                                                        name="products_info[product_qty][]">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputFile" class="required_label">{{ __('Image') }}</label>
                                                    @include('backends.product.partial.product_galleries')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-end pt-2">
                                        <button type="submit" class="btn bg-gradient-primary btn-sm submit float-right mb-0">
                                            <i class="fa fa-save pe-1"></i>
                                            {{__('Save')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            const maxWidthOrHeight = 1024;

            $('.custom-file-input').change(async function (e) {
                const fileInput = $(this);
                const imageNamesHidden = fileInput.closest('.form-group').find('.image_names_hidden');
                const container = fileInput.closest('.form-group').find('.preview');

                const files = e.target.files;
                if (files.length === 0) return;

                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');

                let uploadedFileNames = imageNamesHidden.val() ? imageNamesHidden.val().split(' ') : [];

                for (const file of files) {
                    try {
                        const options = {
                            maxSizeMB: 0.05,
                            quality: 0.7,
                            maxWidthOrHeight: maxWidthOrHeight,
                            useWebWorker: true,
                            fileType: file.type
                        };

                        const compressedFile = await imageCompression(file, options);
                        formData.append('images[]', compressedFile);
                    } catch (error) {
                        toastr.error("Image compression failed for " + file.name);
                        console.error("Compression error:", error);
                        return;
                    }
                }

                $.ajax({
                    url: "{{ route('save_temp_file') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status === 1) {
                            const tempFiles = response.temp_files;

                            tempFiles.forEach(function (tempFile) {
                                uploadedFileNames.push(tempFile);

                                const imgContainer = $('<div></div>').addClass('img_container');
                                const img = $('<img>').attr('src', "{{ asset('uploads/temp') }}/" + tempFile);
                                imgContainer.append(img);
                                container.append(imgContainer);
                            });

                            imageNamesHidden.val(uploadedFileNames.join(' '));
                        } else {
                            toastr.error(response.msg);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        toastr.error(`Upload failed: ${jqXHR.status} ${errorThrown}`);
                        console.log(jqXHR.responseText);
                    }
                });
            });

            $('.custom-file-input').on('click', function () {
                $(this).closest('.form-group').find('.image_names_hidden').val('');
            });
        });
    </script>
    <script>
        // Function to prevent negative values
        function validatePriceInput(input) {
            if (input.value < 0) {
                input.value = '';
            }
        }

        // Function to prevent typing the minus (-) key
        function preventMinus(event) {
            if (event.key === '-' || event.key === '+') {
                event.preventDefault();
            }
        }
    </script>
@endpush
