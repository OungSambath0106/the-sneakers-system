@push('css')
@endpush
<div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Update Brand') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="{{ route('admin.brand.update', $brand->id) }}" enctype="multipart/form-data"
            class="submit-form" method="post">
            <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="required_label" for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $brand['name'] }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12 px-0">
                    <label for="dropifyInput">{{ __('Image') }} <span class="text-info text-xs">{{ __('Recommend size 512 x 512 px') }}</span> </label>
                    <input type="hidden" name="image_names" class="image_names_hidden">
                    <input type="file" id="dropifyInput" class="dropify custom-file-input" name="image"
                            data-default-file="{{ isset($brand) && $brand->image && file_exists(public_path('uploads/brand/' . $brand->image))
                            ? asset('uploads/brand/' . $brand->image)
                            : '' }}" accept="image/png, image/jpeg">
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
@include('backends.brand.partial.delete_brand_image_modal')
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
        var brandId = "{{ isset($brand) ? $brand->id : null }}";
        var deleteConfirmed = false;

        dropifyInstance.on('dropify.beforeClear', function (event, element) {
            if (!deleteConfirmed) {
                $('#deleteImageModal').modal('show');
                return false;
            }
            deleteConfirmed = false;
        });

        $('.btn-confirm-modal').click(function () {
            if (brandId) {
                $.ajax({
                    url: "{{ route('admin.brand.delete_image') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        brand_id: brandId
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
