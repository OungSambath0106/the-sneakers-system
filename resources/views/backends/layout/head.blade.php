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
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
    <link rel="stylesheet" href="dist/css/checkboxes.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    @stack('css')
</head>

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
    /* ✅ Search Input Styling */
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 6px 12px;
        font-size: 14px;
        margin-left: 10px;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #007bff;
        outline: none;
    }
    .dataTables_wrapper .dataTables_filter label::before {
        font-family: 'Font Awesome 6 Free';
        content: "\f002"; /* Search icon */
        font-weight: 900;
        margin-right: 8px;
    }

    /* ✅ Pagination Button Styling */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        background-color: #007BFF;
        color: #fff !important;
        border-radius: 4px;
        margin: 2px;
        padding: 5px 10px;
        font-size: 14px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #0056b3;
    }

    /* Active Pagination Button */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #28a745 !important;
    }

    /* ✅ Previous/Next Icons */
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous::before {
        font-family: 'Font Awesome 6 Free';
        content: "\f104"; /* Left Arrow Icon */
        font-weight: 900;
        margin-right: 5px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.next::after {
        font-family: 'Font Awesome 6 Free';
        content: "\f105"; /* Right Arrow Icon */
        font-weight: 900;
        margin-left: 5px;
    }

    /* ✅ Table Header Styling */
    #myTable thead th {
        background-color: #3e3e3e;
        color: white;
        text-align: center;
        font-size: 14px;
    }
    .table thead th {
        background-color: #3e3e3e;
        color: white;
        text-align: center;
        font-size: 14px;
    }

    /* ✅ Table Hover Effect */
    #myTable tbody tr:hover {
        background-color: #f1f1f1;
    }

    .dt-layout-cell.dt-layout-end {
        display: none !important;
    }
    .dt-layout-cell.dt-layout-start {
        display: none !important;
    }
    td.dt-empty {
        display: none !important;
    }

    #myTable_filter {
        padding: 1rem 1rem 0 1rem !important;
    }
    th.sorting::before {
        background-color: unset !important;
        content: "\f0de";
        font-family: 'FontAwesome';
    }
    th.sorting::after {
        content: "\f0dd";
        font-family: 'FontAwesome';
    }
    table.dataTable>thead .sorting_asc:before, table.dataTable>thead .sorting_desc:after {
        color: #808080 !important;
    }
</style>

