@push('css')
    <style>
        .image-grid {
            display: grid;
            grid-template-columns: repeat(6, 0fr);
            gap: 10px;
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
        .close-btn {
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
        .image-box:hover .close-btn {
            display: block;
        }
    </style>
@endpush
<div class="col-md-12 px-0 pt-2">
    <div class="card p-2  mb-0" id="card-validation-room"
        style="box-shadow: none !important; border: 1px solid #E1E1E1">
        <div class="image-grid">
            <div class="upload-box custom-file m-0" id="upload-box" style="cursor: pointer; text-align: center;">
                <div class="mt-3"><i class="fa-solid fa-plus fa-lg" style="color:#666666;font-size: 7rem !important;"></i></div>
                <div>{{ __('Drop files or click to upload') }}</div>
                <input type="hidden" name="image_names" class="image_names_hidden">
                <input type="file" class="custom-file-input" name="gallery[]" id="fileUpload"
                    accept="image/png, image/jpeg" style="display: none;" multiple>
            </div>
        </div>
        <div id="galleryError" class="invalid-feedback error d-none mt-2" role="alert">
            <strong>{{ __('Please upload at least one image.') }}</strong>
        </div>
    </div>
</div>

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
                        const imageBox = $(`
                            <div class="image-box">
                                <img src="${e.target.result}" alt="Uploaded Image">
                                <button class="close-btn">&times;</button>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100">0%</div>
                                </div>
                            </div>
                        `);
                        uploadBox.before(imageBox);
                        simulateProgress(imageBox.find('.progress-bar'));
                        imageBox.find('.close-btn').on('click', function() {
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
                    }
                }, 300);
            }

            $('form').on('submit', function() {
                const imageDetails = [];
                const imageNames = $('.image_names_hidden').val().trim().split(' ');

                $('.image-box').each(function(index) {
                    const imgName = imageNames[index] || null;

                    if (imgName) {
                        imageDetails.push(imgName);
                    }
                });

                if (imageDetails.length === 0) {
                    event.preventDefault();
                    $('#galleryError').removeClass('d-none').addClass('d-block');
                    $("#card-validation-room").addClass('is-invalid-card');
                }

                $('.image_names_hidden').val(JSON.stringify(imageDetails));
            });
        });
    </script>
@endpush
