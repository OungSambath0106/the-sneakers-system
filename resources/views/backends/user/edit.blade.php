@extends('backends.master')
@section('contents')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <fieldset class="border fieldset-table px-3 mb-4 my-3">
                        <legend class="w-auto mb-0 pb-0 title-form text-uppercase">{{ __('Update User') }}</legend>
                        <form method="POST" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 ">
                                        <label class="required_label">{{__('First Name')}}</label>
                                        <input type="name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $user->first_name) }}"
                                            name="first_name" placeholder="{{__('Enter First Name')}}">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Last Name')}}</label>
                                        <input type="name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $user->last_name) }}"
                                            name="last_name" placeholder="{{__('Enter Last Name')}}" >
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Username')}}</label>
                                        <input type="name" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->name) }}"
                                            name="username" placeholder="{{__('Enter Username')}}" >
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Phone Number')}}</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}"
                                            name="phone" placeholder="{{__('Enter Phone Number')}}" >
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Telegram Number')}}</label>
                                        <input type="text" class="form-control @error('telegram') is-invalid @enderror" value="{{ old('telegram', $user->telegram) }}"
                                            name="telegram" placeholder="{{__('Enter Telegram Number')}}" >
                                        @error('telegram')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Email')}}</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}"
                                            name="email" placeholder="{{__('Enter Email')}}" >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="">{{__('Password')}}</label> <span class=" font-italic text-secondary ">{{ __('Leave it blank if you don\'t want to change.') }}</span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" value=""
                                            name="password" placeholder="{{__('Enter Password')}}" >
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="gender">{{ __('Gender') }}</label>
                                        <select class="form-control select2" name="gender">
                                            <option value="male" {{ old('gender', $user->gender ?? '') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                            <option value="female" {{ old('gender', $user->gender ?? '') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
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
                                            <option value="">{{ __('Please select role') }}</option>
                                            @foreach ($roles as $id => $name)
                                                <option value="{{ $id }}" {{ $user->roles->first()->id == $id ? 'selected' : '' }}>{{ $name }}</option>
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

                                    {{-- <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">{{__('Image')}}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="hidden" name="image_names" class="image_names_hidden">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image" accept="image/png, image/jpeg">
                                                    <label class="custom-file-label" for="exampleInputFile">{{ $user->image ?? __('Choose file') }}</label>
                                                </div>
                                            </div>
                                            <span class="text-info text-xs">{{ __('Recommend size 512 x 512 px') }}</span>
                                            <div class="preview preview-multiple text-center border rounded mt-2" style="height: 150px">
                                                <div class="update_image">
                                                    <div class="img_container">
                                                        <img src="
                                                        @if ($user->image && file_exists(public_path('uploads/users/' . $user->image)))
                                                            {{ asset('uploads/users/'. $user->image) }}
                                                        @else
                                                            {{ asset('uploads/default-profile.png') }}
                                                        @endif
                                                        " alt="" height="100%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="form-group col-md-6">
                                        <label for="dropifyInput">{{ __('Image') }}</label>
                                        <input type="hidden" name="image_names" class="image_names_hidden">

                                        <input type="file" id="dropifyInput" class="dropify custom-file-input" name="image"
                                               data-default-file="{{ isset($user) && $user->image && file_exists(public_path('uploads/users/' . $user->image))
                                                                    ? asset('uploads/users/' . $user->image)
                                                                    : asset('uploads/default-profile.png') }}"
                                               accept="image/png, image/jpeg">

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
                                            {{__('Update')}}
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
            $('.dropify').dropify(); // Initialize Dropify

            const compressor = new window.Compress();
            const maxSize = 51200; // 50KB in bytes

            $('.custom-file-input').change(async function (e) {
                const fileInput = $(this);
                const imageNamesHidden = fileInput.closest('.form-group').find('.image_names_hidden');

                const output = await compressor.compress([...e.target.files], {
                    size: 0.05, // Max 50KB
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
    <script>
        $(document).ready(function () {
            let dropifyInstance = $('.dropify').dropify(); // Initialize Dropify

            // Handle Dropify image removal
            $(document).on('click', '.dropify-clear', function () {
                let imageName = $('.image_names_hidden').val(); // Get current image name
                console.log("Attempting to delete:", imageName); // Debugging

                if (imageName) {
                    $.ajax({
                        url: "{{ route('admin.user.delete_image') }}", // Ensure this matches your route
                        type: 'POST',
                        data: {
                            image_name: imageName,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.status === 1) {
                                toastr.success("Image removed successfully!");
                                $('.image_names_hidden').val(''); // Clear hidden input
                            } else {
                                toastr.error(response.msg);
                            }
                        },
                        error: function () {
                            toastr.error("Error removing image.");
                        }
                    });
                }
            });
        });
    </script>
@endpush
