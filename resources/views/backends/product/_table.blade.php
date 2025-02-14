<div class="card-body p-0 table-wrapper">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Images') }}</th>
                <th class="">{{ __('Name') }}</th>
                <th>{{ __('Brand') }}</th>
                <th>{{ __('Sale') }}</th>
                <th>{{ __('In Stock') }}</th>
                <th>{{ __('Created By') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($product->productgallery && count($product->productgallery->images) > 0)
                            <div class="custom-carousel carousel-{{ $product->id }}" data-product-id="{{ $product->id }}" data-current-index="0">
                                @foreach ($product->productgallery->images as $index => $image)
                                    <img src="{{ file_exists(public_path('uploads/products/' . $image)) ? asset('uploads/products/' . $image) : asset('uploads/default.png') }}"
                                        alt="Product Image" class="carousel-image profile_img_table"
                                        style="display: {{ $index == 0 ? 'block' : 'none' }};">
                                @endforeach
                            </div>
                        @else
                            <img src="{{ !empty($product->image[0]) && file_exists(public_path('uploads/products/' . $product->image[0])) ? asset('uploads/products/' . $product->images[0]) : asset('uploads/default.png') }}"
                                alt="Product Image" class="profile_img_table">
                        @endif
                    </td>
                    <td>
                        <span class="ml-2">
                            {{ $product->name ?? 'Null' }}
                        </span>
                    </td>
                    <td>{{ $product->brand->name ?? 'Null' }}</td>
                    <td>{{ $product->count_product_sale ?? '0' }}</td>
                    <td>{{ $product->total_qty ?? '0' }}</td>
                    <td>{{ $product->createdBy->name ?? 'Null' }}</td>
                    <td>
                        <div class="ckbx-style-9 mt-2">
                            <input type="checkbox" class="status"
                                id="status_{{ $product->id }}" data-id="{{ $product->id }}"
                                {{ $product->status == 1 ? 'checked' : '' }} name="status">
                            <label for="status_{{ $product->id }}"></label>
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
            @empty
                <tr>
                    <td colspan="9" class="text-center" style="background-color: ghostwhite">{{ __('Products are not available.') }}</td>
                </tr>
            @endforelse
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
    document.addEventListener("DOMContentLoaded", function () {
        const carousels = document.querySelectorAll(".custom-carousel");

        carousels.forEach(carousel => {
            const images = carousel.querySelectorAll(".carousel-image");
            let currentIndex = 0;

            carousel.addEventListener("click", function () {
                images[currentIndex].style.display = "none";

                currentIndex = (currentIndex + 1) % images.length;

                images[currentIndex].style.display = "block";
            });
        });
    });
</script>
