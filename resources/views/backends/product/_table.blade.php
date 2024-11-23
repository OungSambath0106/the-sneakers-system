<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Images') }}</th>
                <th class="">{{ __('Name') }}</th>
                <th>{{ __('Category') }}</th>
                <th>{{ __('Created By') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($product->images && count($product->images) > 1)
                            <div id="carousel-{{ $product->id }}" class="custom-carousel" data-current-index="0">
                                @foreach ($product->images as $index => $image)
                                    <img src="{{ file_exists(public_path('uploads/products/' . $image)) ? asset('uploads/products/' . $image) : asset('uploads/default.png') }}"
                                        alt="Product Image" class="carousel-image profile_img_table"
                                        style="display: {{ $index == 0 ? 'block' : 'none' }};">
                                @endforeach
                            </div>
                        @else
                            <img src="{{ !empty($product->images[0]) && file_exists(public_path('uploads/products/' . $product->images[0])) ? asset('uploads/products/' . $product->images[0]) : asset('uploads/default.png') }}"
                                alt="Product Image" class="profile_img_table">
                        @endif
                    </td>
                    <td>
                        <span class="ml-2">
                            {{ $product->name ?? 'Null' }}
                        </span>
                    </td>
                    <td>{{ $product->brand->name ?? 'Null' }}</td>
                    <td>{{ $product->createdBy->name ?? 'Null' }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input switcher_input status"
                                id="status_{{ $product->id }}" data-id="{{ $product->id }}"
                                {{ $product->status == 1 ? 'checked' : '' }} name="status">
                            <label class="custom-control-label" for="status_{{ $product->id }}"></label>
                        </div>
                    </td>
                    <td>
                        @if (auth()->user()->can('product.edit'))
                            <a href="{{ route('admin.product.edit', $product->id) }}"
                                class="btn btn-info btn-sm btn-edit">
                                <i class="fas fa-pencil-alt"></i>
                                {{ __('Edit') }}
                            </a>
                        @endif
                        @if (auth()->user()->can('product.delete'))
                            <form action="{{ route('admin.product.destroy', $product->id) }}"
                                class="d-inline-block form-delete-{{ $product->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" data-id="{{ $product->id }}"
                                    data-href="{{ route('admin.product.destroy', $product->id) }}"
                                    class="btn btn-danger btn-sm btn-delete">
                                    <i class="fa fa-trash-alt"></i>
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $products->firstItem() }} {{ __('to') }} {{ $products->lastItem() }}
                    {{ __('of') }} {{ $products->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $products->links() }}</div>
            </div>
        </div>
    </div>


</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const carousel = document.getElementById("carousel-{{ $product->id }}");
        if (carousel) {
            const images = carousel.querySelectorAll(".carousel-image");
            let currentIndex = 0;

            carousel.addEventListener("click", function() {
                images[currentIndex].style.display = "none";

                currentIndex = (currentIndex + 1) % images.length;

                images[currentIndex].style.display = "block";
            });
        }
    });
</script>
