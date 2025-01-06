<div class="card-body p-0 table-wrapper">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Discount Type') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Banner') }}</th>
                <th>{{ __('Start Date') }}</th>
                <th>{{ __('End Date') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($promotions as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->discount_type ?? 'Null' }}</td>
                    <td>{{ $item->title ?? 'Null' }}</td>
                    {{-- <td>
                        <img width="90%" height="auto" src="
                        @if ($item->banner && file_exists(public_path('uploads/promotions/' . $item->banner))) {{ asset('uploads/promotions/' . $item->banner) }}
                        @else
                        {{ asset('uploads/default.png') }} @endif
                        "
                        alt="" class="banner_img_table" style="object-fit: cover">
                    </td> --}}
                    <td>
                        @if ($item->promotiongallery && count($item->promotiongallery->images) > 0)
                            <div class="custom-carousel carousel-{{ $item->id }}" data-promotion-id="{{ $item->id }}" data-current-index="0">
                                @foreach ($item->promotiongallery->images as $index => $image)
                                    <img src="{{ file_exists(public_path('uploads/promotions/' . $image)) ? asset('uploads/promotions/' . $image) : asset('uploads/default.png') }}"
                                        alt="Promotion Image" class="carousel-image banner_img_table"
                                        style="display: {{ $index == 0 ? 'block' : 'none' }};">
                                @endforeach
                            </div>
                        @else
                            <img src="{{ !empty($item->image[0]) && file_exists(public_path('uploads/promotions/' . $item->image[0])) ? asset('uploads/promotions/' . $item->image[0]) : asset('uploads/default.png') }}"
                                alt="Promotion Image" class="banner_img_table">
                        @endif
                    </td>
                    <td> {{ \Carbon\Carbon::parse($item->start_date)->format('F d, Y') }} </td>
                    <td> {{ \Carbon\Carbon::parse($item->end_date)->format('F d, Y') }} </td>
                    <td>
                        <div class="ckbx-style-9 mt-2">
                            <input type="checkbox" class="status"
                                id="status_{{ $item->id }}" data-id="{{ $item->id }}"
                                {{ $item->status == 1 ? 'checked' : '' }} name="status">
                            <label for="status_{{ $item->id }}"></label>
                        </div>
                    </td>

                    <td>
                        <a href="{{ route('admin.promotion.edit', $item->id) }}" class="btn btn-info btn-sm btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('admin.promotion.destroy', $item->id) }}"
                            class="d-inline-block form-delete-{{ $item->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $item->id }}"
                                data-href="{{ route('admin.promotion.destroy', $item->id) }}"
                                class="btn btn-danger btn-sm btn-delete">
                                <i class="fa fa-trash-alt"></i>
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="background-color: ghostwhite">{{ __('Promotions are not available.') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12  text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $promotions->firstItem() }} {{ __('to') }} {{ $promotions->lastItem() }}
                    {{ __('of') }} {{ $promotions->total() }} {{ __('entries') }}
                </div>
                <div class="col-12  pagination-nav pr-3"> {{ $promotions->links() }}</div>
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
