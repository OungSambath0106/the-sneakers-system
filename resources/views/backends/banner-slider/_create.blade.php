@push('css')
@endpush
<div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Add Banner Slider') }}</h5>
            <button type="button" class="close btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="{{ route('admin.banner-slider.store') }}" enctype="multipart/form-data" class="submit-form"
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
                    <label for="dropifyInput">{{ __('Image') }} <span class="text-info text-xs"> {{ __('Recommend size 1080 x 500 px') }} </span> </label>
                    <input type="hidden" name="image_names" class="image_names_hidden">
                    <input type="file" id="dropifyInput" class="dropify custom-file-input" name="image" accept="image/png, image/jpeg">
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

<script>
    $(document).ready(function () {
        var dropifyInput = $('.dropify').dropify();

        $('.custom-file-input').change(async function (e) {
            const fileInput = $(this);
            const imageNamesHidden = fileInput.closest('.form-group').find('.image_names_hidden');
            const progressBarContainer = fileInput.closest('.form-group').find('.progress');
            const progressBar = progressBarContainer.find('.progress-bar');

            const file = e.target.files[0];
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if (!allowedTypes.includes(file.type)) {
                toastr.error('Only JPG, JPEG, and PNG files are allowed.');
                return;
            }

            const formData = new FormData();
            progressBarContainer.show();
            updateProgressBar(progressBar, 0);

            try {
                // Resize and convert to WebP
                const webpFile = await resizeAndConvertToWebP(file, 1080, 500);

                formData.append('image', webpFile);
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
                toastr.error("Image processing failed.");
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

        async function resizeAndConvertToWebP(file, targetWidth, targetHeight) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const img = new Image();
                    img.onload = function () {
                        const canvas = document.createElement('canvas');
                        canvas.width = targetWidth;
                        canvas.height = targetHeight;
                        const ctx = canvas.getContext('2d');

                        ctx.drawImage(img, 0, 0, targetWidth, targetHeight);

                        canvas.toBlob((blob) => {
                            if (blob) {
                                const webpFile = new File([blob], file.name.replace(/\.(jpg|jpeg|png)$/i, '.webp'), { type: 'image/webp' });
                                resolve(webpFile);
                            } else {
                                reject(new Error('Failed to create WebP blob.'));
                            }
                        }, 'image/webp', 1.0);
                    };
                    img.onerror = reject;
                    img.src = event.target.result;
                };
                reader.onerror = reject;
                reader.readAsDataURL(file);
            });
        }
    });
</script>
