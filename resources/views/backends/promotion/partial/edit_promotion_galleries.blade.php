@push('css')
    <style>
        .image-grid {
            display: grid;
            grid-template-columns: repeat(6, 0fr);
            gap: 10px;
            /* margin-top: 20px; */
        }

        .image-box {
            width: 11.73rem;
            border: 1px solid #ccc;
            border-radius: 1px;
            padding: 7px;
            background-color: #E1E1E1;
            text-align: center;
            position: relative;
        }

        .div-form {
            margin-top: 0.5rem;
        }

        .progress {
            margin-top: 0.5rem;
            border-radius: 6px;
            height: 12px !important;
        }

        .image-box img {
            width: 11rem;
            height: auto;
            object-fit: cover;
            /* max-width: 100%; */
            /* border-radius: 5px; */
        }

        .image-box .description {
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }

        .upload-box {
            width: 12rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* border: 2px dashed #ccc; */
            border-radius: 2px;
            min-height: 121px;
            font-size: 11px;
            color: black;
            cursor: pointer;
            margin-top: 10px;
            text-align: center;
            background-color: #E1E1E1;
        }

        .upload-box div .fa-lg {
            margin-bottom: 8px;
        }


        .remove-image {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #fff;
            border: none;
            color: red;
            font-size: 20px;
            cursor: pointer;
            display: none;
            width: 2rem;
        }

        .image-box:hover .remove-image {
            display: block;
        }
    </style>
@endpush
<div class="col-md-12 px-0 pt-2">
    <div class="card p-2 mb-0" style="box-shadow:none !important;border:1px solid #E1E1E1 !important">
        <div class="image-grid">
            {{-- @dd($promotion->promotiongallery) --}}
            <input type="hidden" name="promotion_id" class="promotion_id" value="{{ $promotion->id }}">

            @if (@$promotion->promotiongallery)
                @php
                    $images = $promotion->promotiongallery->images;
                @endphp
                @foreach ($images as $index => $image)
                    @if (isset($image))
                        <div class="image-box" data-image-id="{{ $index }}">
                            <input type="hidden" name="name_images[]" value="{{ $image }}">
                            <img src="{{ asset('uploads/promotions/' . $image) }}"
                                alt="promotion_image" height="150px">
                            <button type="button" class="remove-image">&times;</button>
                        </div>
                    @endif
                @endforeach
            @endif
            <div class="upload-box custom-file m-0" id="upload-box" style="cursor: pointer; text-align: center;">
                <div class="mt-3"><i class="fa-solid fa-plus fa-lg" style="color:#666666;font-size: 7rem !important;"></i></div>
                <div>{{ __('Drop files or click to upload') }}</div>
                <input type="hidden" name="image_names" class="promotion_image_names_hidden">
                <input value="" type="file" class="custom-file-input" name="gallery[]" id="fileUpload"
                    accept="image/png, image/jpeg" style="display: none;" multiple>
            </div>
        </div>
    </div>
</div>
@include('backends.promotion.partial.delete-gallery-modal')

@push('js')
    <script>
        document.querySelector('.upload-box').addEventListener('click', function() {
            document.getElementById('fileUpload').click();
        });

        $(document).ready(function() {
            $('#fileUpload').on('change', function(event) {
                const files = event.target.files;
                const imageGrid = $('.image-grid');
                const uploadBox = $('#upload-box');

                $.each(files, function(index, file) {
                    if (!file.type.startsWith('image/')) {
                        alert('Please upload a valid image file.');
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        console.log(file.name);

                        const imageBox = $(`
                            <div class="image-box">
                                <img src="${e.target.result}" alt="Uploaded Image">
                                <button type="button" class="remove-image">&times;</button>
                                <div class="progress" style="display: none;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100">0%</div>
                                </div>
                            </div>
                        `);

                        // imageGrid.append(imageBox);
                        uploadBox.before(imageBox);
                        simulateProgress(imageBox.find('.progress-bar'));
                        imageBox.find('.remove-image').on('click', function() {
                            imageBox.remove();
                        });
                    };
                    reader.readAsDataURL(file);
                });
            });

            function simulateProgress(progressBar) {
                let progress = 0;
                progressBar.closest('.progress').show();

                const interval = setInterval(function() {
                    progress += 10;
                    progressBar.css('width', progress + '%');
                    progressBar.text(progress + '%');
                    progressBar.attr('aria-valuenow', progress);

                    if (progress >= 100) {
                        clearInterval(interval);
                        progressBar.closest('.progress').hide();

                        // sendImageDetails();
                    }
                }, 300);
            }

            $('form').on('submit', function() {
                const imageDetails = [];
                const imageNames = $('.promotion_image_names_hidden').val().trim().split(' ');
                var promotionId = $('.promotion_id').val();

                $('.image-box').each(function(index) {
                    const imgName = imageNames[index] || null;

                    if (imgName) {
                        imageDetails.push(imgName);
                    }
                });

                console.log('Image details to be sent:', imageDetails);
                if (imageDetails.length === 0) {
                    console.log('No images to upload. Please select valid images.');
                    return;
                }

                $('.promotion_image_names_hidden').val(JSON.stringify(imageDetails));
            });
        });
    </script>
    <script>
        let imageBoxToDelete;
        $(document).on('click', '.remove-image', function() {
            const imageBox = $(this).closest('.image-box');
            const imageSrc = imageBox.find('img').attr('src');
            const imageName = imageSrc.split('/').pop();
            const promotionId = {{ $promotion->id }};

            $('#image-to-delete').attr('src', imageSrc);
            imageBoxToDelete = imageBox;
            $('#delete-gallery-modal').modal('show');

            $('#confirm-delete').off('click').on('click', function() {
                $.ajax({
                    url: '{{ route('admin.promotion.delete_gallery') }}',
                    type: 'DELETE',
                    data: {
                        name: imageName,
                        promotion_id: promotionId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            imageBoxToDelete.remove();
                            $('#delete-gallery-modal').modal('hide');
                        } else {
                            console.log('Error deleting image: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error deleting image. Please try again.');
                    }
                });

            });
        });
    </script>
@endpush
