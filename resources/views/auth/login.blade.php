<!doctype html>
<html lang="en">

<head>
    <title>BeFree Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('backend/login-form/css/style.css') }}">

    {{--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> --}}
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

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #1f293a inset !important;
            -webkit-text-fill-color: #fff !important;
        }

        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap");

        * {
            margin: 0;
            padding: 0;
            font-family: "Poppins";
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #1f293a;
            min-height: 100vh;
        }

        .container {
            position: relative;
            width: 256px;
            height: 256px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container span {
            position: absolute;
            left: 0;
            width: 32px;
            height: 6px;
            background: #2c4766;
            border-radius: 8px;
            transform-origin: 128px;
            transform: scale(2.2) rotate(calc(var(--i) * (360deg / 50)));
            animation: animateBlink 3s linear infinite;
            animation-delay: calc(var(--i) * (3s / 50));
        }

        @keyframes animateBlink {
            0% {
                background: #0ef;
            }

            25% {
                background: #2c4766;
            }
        }

        .login-box {
            position: absolute;
            width: 400px;
        }

        .login-box form {
            width: 100%;
            padding: 0 50px;
        }

        h2 {
            font-size: 2em;
            color: #0ef;
            text-align: center;
        }

        .input-box {
            position: relative;
            margin: 25px 0;
        }

        .input-box input {
            width: 100%;
            height: 50px;
            background: transparent;
            border: 2px solid #2c4766;
            outline: none;
            border-radius: 40px;
            font-size: 1em;
            color: #fff;
            padding: 0 20px;
            transition: 0.5s;
        }

        .input-box input:focus,
        .input-box input:valid {
            border-color: #0ef;
        }

        .input-box label {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            font-size: 1em;
            color: #fff;
            pointer-events: none;
            transition: 0.5s ease;
        }

        .input-box input:focus~label,
        .input-box input:valid~label {
            top: 1px;
            font-size: 0.8em;
            background-color: #1f293a;
            padding: 0 6px;
            color: #0ef;
        }

        .forgot-password {
            margin: -15px 0 10px;
            text-align: center;
        }

        .forgot-password a {
            font-size: 0.85em;
            color: #fff;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            height: 45px;
            border-radius: 45px;
            background: #0ef;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1em;
            color: #1f293a;
            font-weight: 600;
        }

        .signup-link {
            margin: 20px 0 10px;
            text-align: center;
        }

        .signup-link a {
            font-size: 1em;
            color: #0ef;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-box">
            <h2>Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-box">
                    <input type="email" class="form-control text-white @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="Email" autofocus>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <input type="password" class="form-control text-white @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    <label>Password</label>
                </div>
                <div class="forgot-password">
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>

        <span style="--i:0;"></span>
        <span style="--i:1;"></span>
        <span style="--i:2;"></span>
        <span style="--i:3;"></span>
        <span style="--i:4;"></span>
        <span style="--i:5;"></span>
        <span style="--i:6;"></span>
        <span style="--i:7;"></span>
        <span style="--i:8;"></span>
        <span style="--i:9;"></span>
        <span style="--i:10;"></span>
        <span style="--i:11;"></span>
        <span style="--i:12;"></span>
        <span style="--i:13;"></span>
        <span style="--i:14;"></span>
        <span style="--i:15;"></span>
        <span style="--i:16;"></span>
        <span style="--i:17;"></span>
        <span style="--i:18;"></span>
        <span style="--i:19;"></span>
        <span style="--i:20;"></span>
        <span style="--i:21;"></span>
        <span style="--i:22;"></span>
        <span style="--i:23;"></span>
        <span style="--i:24;"></span>
        <span style="--i:25;"></span>
        <span style="--i:26;"></span>
        <span style="--i:27;"></span>
        <span style="--i:28;"></span>
        <span style="--i:29;"></span>
        <span style="--i:30;"></span>
        <span style="--i:31;"></span>
        <span style="--i:32;"></span>
        <span style="--i:33;"></span>
        <span style="--i:34;"></span>
        <span style="--i:35;"></span>
        <span style="--i:36;"></span>
        <span style="--i:37;"></span>
        <span style="--i:38;"></span>
        <span style="--i:39;"></span>
        <span style="--i:40;"></span>
        <span style="--i:41;"></span>
        <span style="--i:42;"></span>
        <span style="--i:43;"></span>
        <span style="--i:44;"></span>
        <span style="--i:45;"></span>
        <span style="--i:46;"></span>
        <span style="--i:47;"></span>
        <span style="--i:48;"></span>
        <span style="--i:49;"></span>
    </div>

    {{-- <section class="ftco-section h-100vh py-0">
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
                                    <h2 class="heading-section d-flex justify-content-center flex-column"
                                        style="align-items: center;">
                                        <img src="
                                                    @if ($data['web_header_logo'] && file_exists('uploads/business_settings/' . $data['web_header_logo'])) {{ asset('uploads/business_settings/' . $data['web_header_logo']) }}
                                                    @else
                                                        {{ asset('uploads/image/default.png') }} @endif
                                                    " class="custom-logo" alt="Booking Engine">
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
                                        style="margin-bottom: 20px; background-color: #3d95d0;">{{ __('Log In')
                                        }}</button>
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
    </section> --}}

    {{--
    <script src="{{ asset('backend/login-form/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/login-form/js/popper.js') }}"></script>
    <script src="{{ asset('backend/login-form/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/login-form/js/main.js') }}"></script> --}}

</body>

</html>