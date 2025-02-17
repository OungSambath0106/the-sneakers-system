@extends('backends.master')
@section('contents')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <fieldset class="border fieldset-table px-3 mb-4 my-3">
                        <legend class="w-auto mb-0 pb-0 title-form text-uppercase">{{ __('Add New User') }}</legend>
                        <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 ">
                                        <label class="required_label">{{__('First Name')}}</label>
                                        <input type="name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}"
                                            name="first_name" placeholder="{{__('John')}}">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Last Name')}}</label>
                                        <input type="name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}"
                                            name="last_name" placeholder="{{__('Doe')}}" >
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Username')}}</label>
                                        <input type="name" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"
                                            name="username" placeholder="{{__('Enter Username')}}" >
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Phone Number')}}</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                            name="phone" placeholder="{{__('+855 12 345 678')}}" >
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Telegram Number')}}</label>
                                        <input type="text" class="form-control @error('telegram') is-invalid @enderror" value="{{ old('telegram') }}"
                                            name="telegram" placeholder="{{__('+855 12 345 678')}}" >
                                        @error('telegram')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Email')}}</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                            name="email" placeholder="{{__('john.doe@example.com')}}" >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Password')}}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" value=""
                                            name="password" placeholder="{{__('Must have at least 8 characters')}}" >
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="gender">{{__('Gender')}}</label>
                                        <select class="form-control select2" name="gender">
                                            <option value="male">{{__('Male')}}</option>
                                            <option value="female">{{__('Female')}}</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="role">{{__('Role')}}</label>
                                        <select name="role" id="role" class="form-control select2 @error('password') is-invalid @enderror">
                                            @foreach ($roles as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group col-md-6">
                                        <label>{{__('Address')}}</label>
                                        <input type="text" class="form-control" value="{{ old('address') }}"
                                            name="address" placeholder="{{__('Enter Address')}}" >
                                    </div> --}}

                                    <div class="form-group col-md-6">
                                        <label for="dropifyInput">{{ __('Image') }}</label>
                                        <input type="hidden" name="image_names" class="image_names_hidden">
                                        <input type="file" id="dropifyInput" class="dropify custom-file-input" name="image" accept="image/png, image/jpeg">
                                        <span class="text-info text-xs">{{ __('Recommend size 512 x 512 px') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <a href="javascript:history.back()" class="text-white btn btn-danger text-decoration-none">
                                            <i class="fas fa-arrow-left"></i>
                                            {{__('Back')}}
                                        </a>
                                    </div>
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i>
                                            {{__('Save')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
            const compressor = new window.Compress();
            const maxSize = 51200;
            $('.custom-file-input').change(async function (e) {
                const fileInput = $(this);
                const imageNamesHidden = fileInput.closest('.form-group').find('.image_names_hidden');
                const output = await compressor.compress([...e.target.files], {
                    size: 0.05,
                    quality: 0.7,
                    maxWidth: 512,
                    maxHeight: 512
                });
                const compressedFile = Compress.convertBase64ToFile(output[0].data, output[0].ext);
                if (compressedFile.size > maxSize) return toastr.error("The image size exceeds 50KB. Please choose a smaller file.");
                const formData = new FormData();
                formData.append('image', compressedFile);
                $.post({
                    url: "{{ route('save_temp_file') }}",
                    data: formData,
                    processData: false,
                    contentType: false
                }).done(response => {
                    response.status === 1 ? imageNamesHidden.val(response.temp_files) : toastr.error(response.msg);
                }).fail(() => toastr.error("Error uploading image"));
            });
        });
    </script>
@endpush
