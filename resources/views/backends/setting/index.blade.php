@extends('backends.master')
@push('css')
    <style>
        .preview {
            margin-block: 12px;
            text-align: center;
        }
        .video-preview {
            margin-block: 12px;
            text-align: center;
        }
        .tab-pane {
            margin-top: 20px
        }
    </style>
@endpush
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('Business Setting') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    @include('backends.setting.partials.tab')
                </div>
                <div class="">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">
                            <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Company Information') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        {{-- @include('backends.setting.partials._lang_tab', [
                                                            'tab_id' => 'company',
                                                        ]) --}}
                                                        <div class="tab-content" id="custom-content-below-tabContent">
                                                            @foreach (json_decode($language, true) as $key => $lang)
                                                                @if ($lang['status'] == 1)
                                                                    <?php
                                                                    $translate = [];
                                                                    foreach ($settings as $setting) {
                                                                        if (count($setting['translations'])) {
                                                                            // dd($setting['translations']);

                                                                            foreach ($setting['translations'] as $t) {
                                                                                // dd($t);
                                                                                if ($t->locale == $lang['code'] && $t->key == 'company_name') {
                                                                                    $translate[$lang['code']]['company_name'] = $t->value;
                                                                                }
                                                                                if ($t->locale == $lang['code'] && $t->key == 'company_address') {
                                                                                    $translate[$lang['code']]['company_address'] = $t->value;
                                                                                }
                                                                                if ($t->locale == $lang['code'] && $t->key == 'copy_right_text') {
                                                                                    $translate[$lang['code']]['copy_right_text'] = $t->value;
                                                                                }
                                                                                if ($t->locale == $lang['code'] && $t->key == 'company_description') {
                                                                                    $translate[$lang['code']]['company_description'] = $t->value;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <div class="tab-pane fade {{ $lang['code'] == $default_lang ? 'show active' : '' }} mt-0"
                                                                        id="company_lang_{{ $lang['code'] }}"
                                                                        role="tabpanel"
                                                                        aria-labelledby="lang_{{ $lang['code'] }}-tab">
                                                                        <input type="hidden" name="lang[]"
                                                                            value="{{ $lang['code'] }}">
                                                                        <div class="row">
                                                                            <div class="col-12 col-sm-6 col-md-4">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="company_name">{{ __('Company Name') }}</label>
                                                                                    <input type="text"
                                                                                        name="company_name[]"
                                                                                        id="company_name"
                                                                                        class="form-control"
                                                                                        value="{{ $translate[$lang['code']]['company_name'] ?? $company_name }}">
                                                                                </div>
                                                                            </div>
                                                                            @if ($lang['code'] == 'en')
                                                                                <div class="col-12 col-sm-6 col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="">{{ __('Email') }}</label>
                                                                                        <input type="text" name="email"
                                                                                            id="email"
                                                                                            class="form-control"
                                                                                            value="{{ $email }}">
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                            <div class="col-12 col-sm-6 col-md-4">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="copy_right_text">{{ __('Copyright Text') }}</label>
                                                                                    <input type="text"
                                                                                        name="copy_right_text[]"
                                                                                        id="copy_right_text"
                                                                                        class="form-control"
                                                                                        value="{{ $translate[$lang['code']]['copy_right_text'] ?? $copy_right_text }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="company_address">{{ __('Company Address') }}</label>
                                                                                    <input type="text"
                                                                                        name="company_address[]"
                                                                                        id="company_address"
                                                                                        class="form-control"
                                                                                        value="{{ $translate[$lang['code']]['company_address'] ?? $company_address }}">

                                                                                </div>
                                                                            </div>
                                                                            @if ($lang['code'] == 'en')
                                                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="copy_right_text">{{ __('Link Google Map') }}</label>
                                                                                        <input type="text"
                                                                                            name="link_google_map"
                                                                                            id="link_google_map"
                                                                                            class="form-control"
                                                                                            value="{{ $link_google_map }}">
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                            {{-- <div class="col-12 col-sm-12 col-md-12">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="company_description_{{ $lang['code'] }}">{{ __('Company Description') }}({{ strtoupper($lang['code']) }})</label>
                                                                                    <textarea name="company_description[]" id="company_description_{{ $lang['code'] }}"
                                                                                        class="form-control value_summernote" rows="6">{{ $translate[$lang['code']]['company_description'] ?? $company_description }}</textarea>
                                                                                </div>
                                                                            </div> --}}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card" hidden>
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Home Slider') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        @include('backends.setting.partials._lang_tab', [
                                                            'tab_id' => 'home_slider',
                                                        ])
                                                        <div class="tab-content" id="custom-content-below-tabContent">
                                                            @foreach (json_decode($language, true) as $key => $lang)
                                                                @if ($lang['status'] == 1)
                                                                    <?php
                                                                    $translate = [];
                                                                    foreach ($settings as $setting) {
                                                                        if (count($setting['translations'])) {
                                                                            // dd($setting['translations']);

                                                                            foreach ($setting['translations'] as $t) {
                                                                                // dd($t);
                                                                                if ($t->locale == $lang['code'] && $t->key == 'slider_title') {
                                                                                    $translate[$lang['code']]['slider_title'] = $t->value;
                                                                                }
                                                                                if ($t->locale == $lang['code'] && $t->key == 'slider_description') {
                                                                                    $translate[$lang['code']]['slider_description'] = $t->value;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <div class="tab-pane fade {{ $lang['code'] == $default_lang ? 'show active' : '' }} mt-3"
                                                                        id="home_slider_lang_{{ $lang['code'] }}"
                                                                        role="tabpanel"
                                                                        aria-labelledby="lang_{{ $lang['code'] }}-tab">
                                                                        <input type="hidden" name="lang[]"
                                                                            value="{{ $lang['code'] }}">
                                                                        <div class="row">
                                                                            <div class="col-12 col-sm-12 col-md-12">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="slider_title_{{ $lang['code'] }}">{{ __('Title') }}({{ strtoupper($lang['code']) }})</label>
                                                                                    <input type="text"
                                                                                        name="slider_title[]"
                                                                                        id="slider_title{{ $lang['code'] }}"
                                                                                        class="form-control"
                                                                                        value="{{ $translate[$lang['code']]['slider_title'] ?? $slider_title }}">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12 col-sm-12 col-md-12">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="slider_description_{{ $lang['code'] }}">{{ __('Slider Description') }}({{ strtoupper($lang['code']) }})</label>
                                                                                    <textarea name="slider_description[]" id="slider_description_{{ $lang['code'] }}"
                                                                                        class="form-control home_slider_summernote" rows="7">{{ $translate[$lang['code']]['slider_description'] ?? $slider_description }}</textarea>
                                                                                </div>
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
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Contact') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Phone Number') }}</th>
                                                                <th>
                                                                    {{ __('Icon') }}
                                                                    <br>
                                                                    <span class="text-info text-xs">{{ __('Recommend svg icon') }}</span>
                                                                </th>
                                                                <th>{{ __('Link') }}</th>
                                                                <th>{{ __('Status') }}</th>
                                                                <th>
                                                                    <button type="button" class="btn btn-success btn-sm btn_add_contact">
                                                                        <i class="fa fa-plus-circle"></i>
                                                                    </button>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        @include('backends.setting.partials._contact_tbody')
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Social Media') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Title') }}</th>
                                                                <th>
                                                                    {{ __('Icon') }}
                                                                    <br>
                                                                    <span class="text-info text-xs">{{ __('Recommend svg icon') }}</span>
                                                                </th>
                                                                <th>{{ __('Link') }}</th>
                                                                <th>{{ __('Status') }}</th>
                                                                <th>
                                                                    <button type="button" class="btn btn-success btn-sm btn_add_social_media">
                                                                        <i class="fa fa-plus-circle"></i>
                                                                    </button>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        @include('backends.setting.partials._social_media_tbody')
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Payment') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Title') }}</th>
                                                                <th>
                                                                    {{ __('Icon') }}
                                                                    <br>
                                                                    <span class="text-info text-xs">{{ __('Recommend svg icon') }}</span>
                                                                </th>
                                                                <th>{{ __('Status') }}</th>
                                                                <th>
                                                                    <button type="button" class="btn btn-success btn-sm btn_add_payment">
                                                                        <i class="fa fa-plus-circle"></i>
                                                                    </button>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        @include('backends.setting.partials._payment_tbody')
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Website Logo setup') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                {{-- <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="timezone">{{ __('Timezone') }}</label>
                                                        <select name="timezone" id="timezone" class="form-control select2">
                                                            <option value="">{{ __('Please Select') }}</option>
                                                            @foreach (config('list.all_timezone') as $value => $name)
                                                                <option value="{{ $value }}" {{ $timezone == $value ? 'selected' : '' }}>{{ $name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="currency">{{ __('Currency') }}</label>
                                                       <select name="currency" id="currency" class="form-control select2">
                                                            <option value="">{{ __('Please Select') }}</option>
                                                            @foreach (config('list.currency_list') as $item)
                                                                <option value="{{ $item['code'] }}" {{ $item['code'] == $currency ? 'selected' : '' }}>{{ $item['symbol'] . ' - ' . $item['name'] }}</option>
                                                            @endforeach
                                                       </select>
                                                    </div>
                                                </div>
                                            </div> --}}
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="web_header_logo">{{ __('Website logo') }}</label>
                                                            <div class="preview">
                                                                <img src="
                                                            @if ($web_header_logo && file_exists('uploads/business_settings/' . $web_header_logo)) {{ asset('uploads/business_settings/' . $web_header_logo) }}
                                                            @else
                                                                {{ asset('uploads/image/default.png') }} @endif
                                                            "
                                                                    alt="" height="150px" width="190px" style="object-fit: cover;">
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="customFile" name="web_header_logo">
                                                                <label class="custom-file-label"
                                                                    for="customFile">{{ __('Choose file') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="fav_icon">{{ __('Fav icon') }}</label>
                                                            <div class="preview">
                                                                <img src="
                                                            @if ($fav_icon && file_exists('uploads/business_settings/' . $fav_icon)) {{ asset('uploads/business_settings/' . $fav_icon) }}
                                                            @else
                                                                {{ asset('uploads/image/default.png') }} @endif
                                                            "
                                                                    alt="" height="150px" width="190px" style="object-fit: cover;">
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="customFile" name="fav_icon">
                                                                <label class="custom-file-label"
                                                                    for="customFile">{{ __('Choose file') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <button type="submit" class="btn btn-primary float-right">
                                                    <i class="fas fa-save"></i>
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

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
        $('.home_slider_summernote').summernote({
            placeholder: '{{ 'Type something' }}',
            tabsize: 2,
            height: 150,
        });
        $('.value_summernote').summernote({
            placeholder: '{{ 'Type something' }}',
            tabsize: 2,
            height: 250,

        });
        $('.btn_add_contact').click(function(e) {
            var tbody = $('.contact_tbody');
            var numRows = tbody.find("tr").length;
            $.ajax({
                type: "get",
                url: window.location.href,
                data: {
                    "type": "key_contact",
                    "key": numRows
                },
                dataType: "json",
                success: function(response) {
                    $(tbody).append(response.tr);
                }
            });
        });
        $('.btn_add_social_media').click(function(e) {
            var tbody = $('.tbody');
            var numRows = tbody.find("tr").length;
            $.ajax({
                type: "get",
                url: window.location.href,
                data: {
                    "type": "key_social",
                    "key": numRows
                },
                dataType: "json",
                success: function(response) {
                    $(tbody).append(response.tr);
                }
            });
        });
        $('.btn_add_payment').click(function(e) {
            var tbody = $('.payment_tbody');
            var numRows = tbody.find("tr").length;
            $.ajax({
                type: "get",
                url: window.location.href,
                data: {
                    "type": "key_payment",
                    "key": numRows
                },
                dataType: "json",
                success: function(response) {
                    $(tbody).append(response.tr);
                }
            });
        });

        const compressor = new window.Compress();

        $(document).on('click', 'button[type=submit]', function(e) {
            e.preventDefault();
            // alert('okk');
            $('.home_images_wrapper input[type=file]').attr('disabled', true);
            $(this).closest('form').submit();
        });
    </script>
@endpush
