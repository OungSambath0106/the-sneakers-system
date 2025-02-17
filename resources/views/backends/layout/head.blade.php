<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title', 'Admin Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @php
        $setting = \App\Models\BusinessSetting::all();
        $data['fav_icon'] = @$setting->where('type', 'fav_icon')->first()->value??'';
    @endphp
    <link rel="icon" type="image/x-icon" href="@if ($data['fav_icon'] && file_exists('uploads/business_settings/'. $data['fav_icon']))
            {{ asset('uploads/business_settings/'. $data['fav_icon']) }}
        @else
            {{ asset('uploads/image/default.png') }}
        @endif">
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- flag-icon-css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"> --}}
    <link rel="stylesheet"
        href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}
    {{-- summernote --}}
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="{{ asset('backend/sweetalert2/css/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"
        type="text/css" media="screen" />

    <link rel="stylesheet" href="{{ asset('backend/custom/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/checkboxes.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <!-- Dropify CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/demo.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/dropify.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

    @stack('css')
</head>
<style>
    .dropify-wrapper .dropify-message span.file-icon p {
        font-size: 20px !important;
        color: #CCC;
    }
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:before {
        content: " 🠗" !important;
        font-size: 18px !important;
        opacity: 1;
        color: #000;
        padding-right: 6px;
        line-height: 0 !important;
    }
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_desc:after {
        content: " 🠕" !important;
        font-size: 18px !important;
        line-height: 0 !important;
    }
    #bookingTable_first {
        margin: 0 !important;
    }
    .table-wrapper {
        overflow-x: auto;
        -ms-overflow-style: none;  /* Hide scrollbar for IE and Edge */
        scrollbar-width: none; /* Hide scrollbar for Firefox */
    }
    .table-wrapper::-webkit-scrollbar {
        display: none; /* Hide scrollbar for Chrome, Safari, and Opera */
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #007bff !important;
        border: 1px solid #007bff !important;
        color: #007bff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #007bff ;
        border: 1px solid #007bff ;
        color: #FFF !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: #FFF !important;
    }
</style>
<style type="text/css">
    .pagination {
        float: right;
        margin-top: 10px;
    }

    .bootstrap-tagsinput {
        width: 100%;
    }

    .label-info {
        background-color: #17a2b8;

    }

    .label {
        display: inline-block;
        padding: .25em .4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
        transition: color .15s ease-in-out, background-color .15s ease-in-out;
        border-color .15s ease-in-out,
        box-shadow .15s ease-in-out;
    }

    @font-face {
        font-family: 'Montserrat', sans-serif, 'Hanuman';
        src: url('public/font/Hanuman-Light.ttf') format('ttf');
        src: url('public/font/Montserrat-Light.ttf') format('ttf');
    }

    .required_label::after {
        content: " *";
        color: red;

    }

    :root {
        --system-font: 'Montserrat', sans-serif, 'Hanuman';
    }
</style>
<style>
    body {

    }

    .text-sm .btn {
        font-size: 12px !important;
    }

    .dropdown-item {
        cursor: pointer;
    }
</style>
<style>
    #bookingTableButtons {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    #bookingTableButtons .dt-buttons {
        display: flex;
    }
    #bookingTableButtons .dt-buttons .dt-button {
        margin: 0;
        border: 1px solid #DDDDDD;
        border-radius: 0;
        background: #A1E9C9;
        color: #229865;
        padding: .3rem .65rem;
        font-size: 10px;
    }
    #bookingTableButtons input[type="search"] {
        height: 29px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
        width: 200px;
    }
    #bookingTableButtons input[type="search"]:focus,
    #bookingTableButtons input[type="search"]:focus-visible {
        outline: none;
        border-color: #ccc;
        box-shadow: none;
    }
    #bookingTable_length label {
        font-size: 13px;
        font-weight: 400;
        margin-top: .5rem;
    }
    #bookingTable_length label select {
        width: 4rem;
        height: 1.5rem;
        border-radius: 5px;
    }
    #bookingTable_filter label {
        margin: 0;
    }
    #bookingTable_info {
        padding-top: 1.5rem;
    }
    #bookingTable_paginate {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-block: 0rem;
        margin-block: 1rem;
    }
    .table-wrapper {
        overflow-x: auto;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .table-wrapper::-webkit-scrollbar {
        display: none;
    }
</style>
