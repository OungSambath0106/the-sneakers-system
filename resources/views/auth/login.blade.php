<!doctype html>
<html lang="en">

<head>
    <title>BeFree Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('backend/login-form/css/style.css') }}">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> --}}
    <style>
        .custom-logo {
            width: 150px;
        }
        @media screen and (max-width: 768px) {
            .custom-logo {
                width: 100px;
            }
        }
        input.form-control:focus {
            border-color: #3d95d0;
            outline: none;
        }
    </style>
</head>

<body>
    <section class="ftco-section h-100vh py-0">
        <div class="container h-100 d-flex justify-content-center align-items-center w-100">
            <div style="width: min(100%, 650px) !important; background-color: rgba(255, 255, 255, 0.8);"
                class="row align-items-center justify-content-center rounded shadow-sm">
                <div class="col-md-7 col-lg-7 p-0">
                    <div class="">

                        <div class="login-wrap">
                            <div class="d-flex justify-content-center">
                                <div class="">
                                    @php
                                        $business = \App\Models\BusinessSetting::first();
                                        $data['web_header_logo'] =
                                            @$business->where('type', 'web_header_logo')->first()->value ?? '';
                                        $data['company_name'] =
                                            @$business->where('type', 'company_name')->first()->value ?? '';
                                        $data['copy_right_text'] =
                                            @$business->where('type', 'copy_right_text')->first()->value ?? '';
                                    @endphp
                                    <h2 class="heading-section d-flex justify-content-center flex-column" style="align-items: center;">
                                        <img src="
                                                    @if ($data['web_header_logo'] && file_exists('uploads/business_settings/' . $data['web_header_logo'])) {{ asset('uploads/business_settings/' . $data['web_header_logo']) }}
                                                    @else
                                                        {{ asset('uploads/image/default.png') }} @endif
                                                    "
                                            class="custom-logo" alt="Booking Engine">
                                        <h4 class="mt-2" style="color: #3d95d0;">{{ $data['company_name'] }}</h4>
                                    </h2>
                                </div>
                            </div>
                            <br>
                            <form method="POST" action="{{ route('login') }}" class="signin-form">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="label" for="name">{{ __('Email') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="Email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-5">
                                    <label class="label" for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block text-white rounded float-right"
                                        style="margin-bottom: 20px; background-color: #3d95d0;">{{ __('Log In') }}</button>
                                </div>
                                <br>
                                <div class="form-group mb-0 text-center">
                                    <span>{{ $data['copy_right_text'] }}</span>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="{{ asset('backend/login-form/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/login-form/js/popper.js') }}"></script>
    <script src="{{ asset('backend/login-form/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/login-form/js/main.js') }}"></script>

</body>

</html>
