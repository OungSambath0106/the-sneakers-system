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
                    <div class="form-group">
                        <label for="exampleInputFile">{{ __('Image') }}</label>
                        {{-- <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" name="image" class="image_hidden">
                                <input type="file" class="custom-file-input image-file-input" id="exampleInputFile" name="image">
                                <label class="custom-file-label" for="exampleInputFile">{{ $brand->image ? basename($brand->image) : __('Choose file') }}</label>
                            </div>
                        </div> --}}
                        <input type="file" name="image" id="exampleInputFile" class="dropify" />
                        {{-- <div class="preview preview-multiple text-center border rounded mt-2" style="height: 150px">
                            <img src="
                            @if ($brand->image && file_exists(public_path('uploads/brand/' . $brand->image)))
                                {{ asset('uploads/brand/' . $brand->image) }}
                            @else
                                {{ asset('uploads/defualt.png') }}
                            @endif"
                                alt="" height="100%">
                        </div> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary submit float-right">{{__('Save')}}</button>
                        {{-- <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">{{ __('Close') }}</button> --}}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

{{-- @push('js') --}}
<script>
    $('.image-file-input').change(function(e) {
        var reader = new FileReader();
        var preview = $(this).closest('.form-group').find('.preview img');
        reader.onload = function(e) {
            preview.attr('src', e.target.result).show();
        }
        reader.readAsDataURL(this.files[0]);
    });
</script>
{{-- @endpush --}}
