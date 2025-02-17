@extends('backends.master')
@section('contents')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <fieldset class="border fieldset-table px-3 mb-4 my-3">
                        <legend class="w-auto mb-0 pb-0 title-form text-uppercase">{{ __('User Profile') }}</legend>
                        <form method="POST" action="{{ route('admin.update_info', auth()->user()->id) }}" enctype="multipart/form-data">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 ">
                                        <label class="required_label">{{__('First Name')}}</label>
                                        <input type="name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', auth()->user()->first_name) }}"
                                            name="first_name" placeholder="{{__('John')}}">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Last Name')}}</label>
                                        <input type="name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', auth()->user()->last_name) }}"
                                            name="last_name" placeholder="{{__('Doe')}}" >
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Username')}}</label>
                                        <input type="name" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', auth()->user()->name) }}"
                                            name="username" placeholder="{{__('Enter Username')}}" >
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Phone Number')}}</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone) }}"
                                            name="phone" placeholder="{{__('+855 12 345 678')}}" >
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Telegram Number')}}</label>
                                        <input type="text" class="form-control @error('telegram') is-invalid @enderror" value="{{ old('telegram', auth()->user()->telegram) }}"
                                            name="telegram" placeholder="{{__('+855 12 345 678')}}" >
                                        @error('telegram')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label">{{__('Email')}}</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}"
                                            name="email" placeholder="{{__('john.doe@example.com')}}" >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="">{{__('Password')}}</label> <span class=" font-italic text-secondary ">{{ __('Leave it blank if you don\'t want to change.') }}</span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" value=""
                                            name="password" placeholder="{{__('********')}}" >
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="gender">{{ __('Gender') }}</label>
                                        <select class="form-control select2" name="gender">
                                            <option value="male" {{ old('gender', auth()->user()->gender ?? '') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                            <option value="female" {{ old('gender', auth()->user()->gender ?? '') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="dropifyInput">{{ __('Image') }} <span class="text-info text-xs">{{ __('Recommend size 512 x 512 px') }}</span> </label>
                                        <input type="hidden" name="image_names" class="image_names_hidden">
                                        <input type="file" id="dropifyInput" class="dropify custom-file-input" name="image"
                                                data-default-file="{{ null !== auth()->user() && auth()->user()->image && file_exists(public_path('uploads/users/' . auth()->user()->image))
                                                ? asset('uploads/users/' . auth()->user()->image)
                                                : '' }}" accept="image/png, image/jpeg">
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
    <!-- Modal remove image -->
    @include('backends.user.partial.delete_user_image_modal')
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
    <script>
        $(document).ready(function () {
            var dropifyInstance = $('#dropifyInput').dropify();
            var userId = "{{ auth()->user() !== null ? auth()->user()->id : null }}";
            var deleteConfirmed = false;

            dropifyInstance.on('dropify.beforeClear', function (event, element) {
                if (!deleteConfirmed) {
                    $('#deleteImageModal').modal('show');
                    return false;
                }
                deleteConfirmed = false;
            });

            $('.btn-confirm-modal').click(function () {
                if (userId) {
                    $.ajax({
                        url: "{{ route('admin.user.delete.image') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            user_id: userId
                        },
                        success: function (response) {
                            if (response.success) {
                                deleteConfirmed = true;

                                removeDropifyPreview();
                            } else {
                                console.log("Error deleting image.");
                            }
                        },
                        error: function () {
                            console.log("Request failed.");
                        }
                    });
                }
                $('#deleteImageModal').modal('hide');
            });

            $('.btn-cancel-modal').click(function () {
                $('#deleteImageModal').modal('hide');
            });

            function removeDropifyPreview() {
                var dropifyInput = $('#dropifyInput');
                dropifyInput.closest('.dropify-wrapper').find('.dropify-render img').remove();
                dropifyInput.closest('.dropify-wrapper').find('.dropify-preview').css('display', 'none');
                dropifyInput.val('');
            }
        });
    </script>
@endpush
