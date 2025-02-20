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
                    <label for="dropifyInput">{{ __('Image') }} <span class="text-info text-xs"> {{ __('Recommend size 512 x 512 px') }} </span> </label>
                    <input type="hidden" name="image_names" class="image_names_hidden">
                    <input type="file" id="dropifyInput" class="dropify custom-file-input" name="image" accept="image/png, image/jpeg">
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
    $(document).ready(function () {
        var dropifyInput = $('.dropify').dropify();
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

            if (compressedFile.size > maxSize) {
                return toastr.error("The image size exceeds 50KB. Please choose a smaller file.");
            }
            const formData = new FormData();
            formData.append('image', compressedFile);

            $.post({
                url: "{{ route('save_temp_file') }}",
                data: formData,
                processData: false,
                contentType: false
            }).done(response => {
                if (response.status === 1) {
                    imageNamesHidden.val(response.temp_files);
                } else {
                    toastr.error(response.msg);
                }
            }).fail(() => toastr.error("Error uploading image"));
        });

        dropifyInput.on('dropify.afterClear', function (event) {
            $(this).closest('.form-group').find('.image_names_hidden').val('');
        });
    });
</script>
