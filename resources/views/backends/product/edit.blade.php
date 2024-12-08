@extends('backends.master')
@section('contents')
    <style>
        .file-container {
            & > table {
                & > tbody {
                    & > tr {
                        & > td {
                            &:nth-child(3) {
                                text-align: start;
                            }
                        }
                    }
                }
            }
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit Product') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.product.update', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                            {{-- @dump($languages) --}}
                                            @foreach (json_decode($language, true) as $lang)
                                                @if ($lang['status'] == 1)
                                                    <li class="nav-item">
                                                        <a class="nav-link text-capitalize {{ $lang['code'] == $default_lang ? 'active' : '' }}"
                                                            id="lang_{{ $lang['code'] }}-tab" data-toggle="pill"
                                                            href="#lang_{{ $lang['code'] }}" data-lang="{{ $lang['code'] }}"
                                                            role="tab" aria-controls="lang_{{ $lang['code'] }}"
                                                            aria-selected="false">{{ \App\helpers\AppHelper::get_language_name($lang['code']) . '(' . strtoupper($lang['code']) . ')' }}</a>
                                                    </li>
                                                @endif
                                            @endforeach

                                        </ul>
                                        <div class="tab-content" id="custom-content-below-tabContent">
                                            @foreach (json_decode($language, true) as $lang)
                                                @if ($lang['status'] == 1)
                                                    <?php
                                                    if (count($product['translations'])) {
                                                        $translate = [];
                                                        foreach ($product['translations'] as $t) {
                                                            if ($t->locale == $lang['code'] && $t->key == 'name') {
                                                                $translate[$lang['code']]['name'] = $t->value;
                                                            }
                                                            if ($t->locale == $lang['code'] && $t->key == 'description') {
                                                                $translate[$lang['code']]['description'] = $t->value;
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <div class="tab-pane fade {{ $lang['code'] == $default_lang ? 'show active' : '' }} mt-3"
                                                        id="lang_{{ $lang['code'] }}" role="tabpanel"
                                                        aria-labelledby="lang_{{ $lang['code'] }}-tab">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <input type="hidden" name="lang[]"
                                                                    value="{{ $lang['code'] }}">
                                                                <label
                                                                    for="name_{{ $lang['code'] }}">{{ __('Name') }}({{ strtoupper($lang['code']) }})</label>
                                                                <input type="name" id="name_{{ $lang['code'] }}"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    name="name[]" placeholder="{{ __('Enter Name') }}"
                                                                    value="{{ $translate[$lang['code']]['name'] ?? $product['name'] }}">

                                                                @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label
                                                                    for="description_{{ $lang['code'] }}">{{ __('Description') }}({{ strtoupper($lang['code']) }})</label>
                                                                <textarea type="text" id="description_{{ $lang['code'] }}"
                                                                    class="form-control @error('description') is-invalid @enderror" name="description[]"
                                                                    placeholder="{{ __('Enter Description') }}" value="">{{ $translate[$lang['code']]['description'] ?? $product['description'] }}</textarea>

                                                                @error('description')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card no_translate_wrapper">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('General Info') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group row col-md-12 mb-0">
                                        <div class="form-group col-md-2">
                                            <label class="required_lable" for="new-arrival">{{ __('New Arrival') }}</label>
                                            <div class="ckbx-style-9">
                                                <input type="checkbox" id="new-arrival" name="new-arrival" {{ $product->new_arrival ? 'checked' : '' }}>
                                                <label for="new-arrival"></label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="required_lable" for="recommended">{{ __('Recommended') }}</label>
                                            <div class="ckbx-style-9">
                                                <input type="checkbox" id="recommended" name="recommended" {{ $product->recommended ? 'checked' : '' }}>
                                                <label for="recommended"></label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="required_lable" for="popular">{{ __('Most Popular') }}</label>
                                            <div class="ckbx-style-9">
                                                <input type="checkbox" id="popular" name="popular" {{ $product->popular ? 'checked' : '' }}>
                                                <label for="popular"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label class="required_lable" for="brand">{{ __('Brand') }}</label>
                                        <select name="brand_id" id="brand"
                                            class="form-control select2 @error('brand_id') is-invalid @enderror">
                                            <option value="">{{ __('Select Brand') }}</option>
                                            @foreach ($brands as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == old('brand_id', $product->brand_id) ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('brand')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_lable" for="rating">{{ __('Star Rating') }}</label>
                                        <select name="rating" id="rating" class="form-control select2 @error('rating') is-invalid @enderror">
                                            <option value="">{{ __('Select Rating') }}</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}" {{ old('rating', $product->rating) == $i ? 'selected' : '' }}>
                                                    {{ $i }} @if($i < 2){{ __('Star') }}@else{{ __('Stars') }}@endif
                                                </option>
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
                                                    @if ($product->product_info && is_array($product->product_info))
                                                        @foreach ($product->product_info as $key => $pro_info)
                                                            <tr>
                                                                <td>
                                                                    <input type="number" class="form-control"
                                                                        name="products_info[product_size][]" min="0" oninput="validatePriceInput(this)" onkeydown="preventMinus(event)"
                                                                        value="{{ $pro_info['product_size'] ?? '' }}">
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">$</span>
                                                                        </div>
                                                                        <input type="number" class="form-control"
                                                                            name="products_info[product_price][]" min="0" oninput="validatePriceInput(this)" onkeydown="preventMinus(event)"
                                                                            value="{{ $pro_info['product_price'] ?? '' }}">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control"
                                                                        name="products_info[product_qty][]" min="0" oninput="validatePriceInput(this)" onkeydown="preventMinus(event)"
                                                                        value="{{ $pro_info['product_qty'] ?? '' }}">
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <input type="number" class="form-control" min="0" oninput="validatePriceInput(this)" onkeydown="preventMinus(event)"
                                                                    name="products_info[product_size][]">
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">$</span>
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
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputFile">{{ __('Image') }}</label>
                                            @include('backends.product.partial.edit_product_galleries')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 form-group">
                                <button type="submit" class="btn btn-primary float-right">
                                    <i class="fa fa-save"></i>
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('js')
    <script>
        const compressor = new window.Compress();
        $('.custom-file-input').change(function (e) {
            const files = [...e.target.files];
            const image_names_hidden = $(this).closest('.custom-file').find('input[type=hidden]');
            const container = $(this).closest('.form-group').find('.preview');

            if (container.find('img').attr('src') === `{{ asset('uploads/image/default.png') }}`) {
                container.empty();
            }

            let formData = new FormData();

            files.forEach(file => {
                if (file.type === 'image/png') {
                    formData.append('images[]', file);
                } else {
                    compressor.compress([file], {
                        size: 4,
                        quality: 0.75,
                    }).then((output) => {
                        output.forEach(compressed => {
                            const compressedFile = Compress.convertBase64ToFile(compressed.data, compressed.ext);
                            formData.append('images[]', compressedFile);
                        });
                    });
                }
            });

            $.ajax({
                url: "{{ route('save_temp_file') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 0) {
                        toastr.error(response.msg);
                    } else if (response.status == 1) {
                        const temp_files = response.temp_files;
                        temp_files.forEach(temp_file => {
                            const img_container = $('<div></div>').addClass('img_container');
                            const img = $('<img>').attr('src', "{{ asset('uploads/temp') }}" + '/' + temp_file);
                            img_container.append(img);
                            container.append(img_container);

                            const current_file_name = image_names_hidden.val();
                            const new_file_name = current_file_name + ' ' + temp_file;
                            image_names_hidden.val(new_file_name);
                        });
                    }
                }
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
