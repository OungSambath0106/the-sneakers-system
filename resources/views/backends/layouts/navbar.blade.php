<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" style="color: #fff !important;" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" style="color: #fff !important;" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="flag-icon flag-icon-{{ ($current_locale == 'en') ? 'gb' : $current_locale }}"></i>
                </a>
                <div class="dropdown-menu " style="left: -10px">
                    @foreach($available_locales as $locale_name => $available_locale)
                        @if($available_locale === $current_locale)
                            <a href="{{ route('change_language', $available_locale) }}" class="dropdown-item text-capitalize active">
                                <i class="flag-icon flag-icon-{{ ($available_locale == 'en') ? 'gb' : $available_locale }} mr-2"></i> {{ $locale_name }}
                            </a>
                        @else
                            <a href="{{ route('change_language', $available_locale) }}" class="dropdown-item text-capitalize">
                                <i class="flag-icon flag-icon-{{ ($available_locale == 'en') ? 'gb' : $available_locale }} mr-2"></i> {{ $locale_name }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </li>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <h6 class="text-white mb-0">{{ __('Hi') }}, <span class="font-weight-bolder text-white mb-0 text-capitalize pl-2" style="color: #fff !important;"> {{ Auth::user()->name }} </span></h6>
                </li>
            </ul>
        </div>
    </div>
</nav>
