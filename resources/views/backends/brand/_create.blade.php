@push('css')
@endpush
<div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Add Brand') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="{{ route('admin.brand.store') }}" enctype="multipart/form-data" class="submit-form"
            method="post">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="form-group">
                                <label class="required_label" for="name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12 px-0">
                    <div class="form-group">
                        <label for="exampleInputFile">{{ __('Image') }}</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" name="image" class="image_hidden">
                                <input type="file" class="custom-file-input image-file-input" id="exampleInputFile"
                                    name="image">
                                <label class="custom-file-label"
                                    for="exampleInputFile">{{ __('Choose Image') }}</label>
                            </div>
                        </div>
                        <div class="preview preview-multiple text-center border rounded mt-2" style="height: 150px">
                            <img src="{{ asset('uploads\defualt.png') }}" alt="" height="100%">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary submit float-right">{{__('Save')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const compressor = new window.Compress();
    $('.image-file-input').change(function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : 'Choose Image';
        $(this).siblings('.custom-file-label').text(fileName);

        compressor.compress([...e.target.files], {
            size: 4,
            quality: 0.75,
        }).then((output) => {
            var files = Compress.convertBase64ToFile(output[0].data, output[0].ext);
            var formData = new FormData();

            var image_names_hidden = $(this).closest('.custom-file').find('input[type=hidden]');
            var container = $(this).closest('.form-group').find('.preview');
            const defaultImageUrl = "{{ asset('uploads/image/default.png') }}";
            if (container.find('img').attr('src') === defaultImageUrl) {
                container.empty();
            }
            formData.append('image', files);

            $.ajax({
                url: "{{ route('save_temp_file') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    if (response.status == 0) {
                        toastr.error(response.msg);
                    }
                    if (response.status == 1) {
                        container.empty();
                        var temp_file = response.temp_files;
                        var img_container = $('<div></div>').addClass('img_container');
                        var img = $('<img>').attr('src', "{{ asset('uploads/temp') }}" +
                            '/' + temp_file);
                        img_container.append(img);
                        container.append(img_container);

                        var new_file_name = temp_file;
                        console.log(new_file_name);

                        image_names_hidden.val(new_file_name);
                    }
                }
            });
        });
    });
</script>
