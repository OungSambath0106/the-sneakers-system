@push('css')
@endpush
<div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Update Brand') }}</h5>
            <button type="button" class="close btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
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
                    <div class="progress mt-2" style="height: 20px; display: none;">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-end py-2">
                        <button type="submit" class="btn bg-gradient-primary btn-sm submit float-right mb-0">
                            <i class="fa fa-save pe-1"></i>
                            {{__('Save')}}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@include('backends.brand.partial.delete_brand_image_modal')
<script>
    $(document).ready(function () {
        var dropifyInput = $('.dropify').dropify();
        const compressor = new window.Compress();

        $('.custom-file-input').change(async function (e) {
            const fileInput = $(this);
            const imageNamesHidden = fileInput.closest('.form-group').find('.image_names_hidden');
            const progressBarContainer = fileInput.closest('.form-group').find('.progress');
            const progressBar = progressBarContainer.find('.progress-bar');

            const file = e.target.files[0];
            const formData = new FormData();

            progressBarContainer.show();
            updateProgressBar(progressBar, 0);

            try {
                const options = {
                    maxSizeMB: 0.05,
                    quality: 1.0,
                    maxWidthOrHeight: 1024,
                    useWebWorker: true,
                    fileType: file.type
                };

                const compressedFile = await imageCompression(file, options);

                formData.append('image', compressedFile);
                formData.append('_token', '{{ csrf_token() }}');

                simulateProgress(progressBar, function () {
                    $.ajax({
                        url: "{{ route('save_temp_file') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.status === 1) {
                                imageNamesHidden.val(response.temp_files);
                            } else {
                                toastr.error(response.msg);
                            }
                            progressBarContainer.hide();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            toastr.error(`Upload failed: ${jqXHR.status} ${errorThrown}`);
                            console.log(jqXHR.responseText);
                            progressBarContainer.hide();
                        }
                    });
                });

            } catch (error) {
                toastr.error("Image compression failed.");
                console.error(error);
                progressBarContainer.hide();
            }
        });

        dropifyInput.on('dropify.afterClear', function (event) {
            $(this).closest('.form-group').find('.image_names_hidden').val('');
            const progressBarContainer = $(this).closest('.form-group').find('.progress');
            progressBarContainer.hide();
        });

        function simulateProgress(progressBar, callback) {
            let progress = 0;
            const interval = setInterval(function () {
                progress += 10;
                updateProgressBar(progressBar, progress);
                if (progress >= 100) {
                    clearInterval(interval);
                    if (typeof callback === "function") {
                        callback();
                    }
                }
            }, 300);
        }

        function updateProgressBar(progressBar, value) {
            progressBar.css('width', value + '%');
            progressBar.text(value + '%');
            progressBar.attr('aria-valuenow', value);
        }
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
