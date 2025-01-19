<div class="card-body p-0 table-wrapper">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shoessliders as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        <img width="40%" height="auto" src="
                        @if ($item->image && file_exists(public_path('uploads/shoes-slider/' . $item->image))) {{ asset('uploads/shoes-slider/' . $item->image) }}
                        @else
                            {{ asset('uploads/default.png') }} @endif
                        "
                            alt="" class="banner_img_table">
                    </td>

                    <td>
                        <div class="ckbx-style-9 mt-2">
                            <input type="checkbox" class="status"
                                id="status_{{ $item->id }}" data-id="{{ $item->id }}"
                                {{ $item->status == 1 ? 'checked' : '' }} name="status">
                            <label for="status_{{ $item->id }}"></label>
                        </div>
                    </td>

                    <td>
                        <a href="{{ route('admin.shoes-slider.edit', $item->id) }}" class="btn btn-info btn-sm btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('admin.shoes-slider.destroy', $item->id) }}"
                            class="d-inline-block form-delete-{{ $item->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $item->id }}"
                                data-href="{{ route('admin.shoes-slider.destroy', $item->id) }}"
                                class="btn btn-danger btn-sm btn-delete">
                                <i class="fa fa-trash-alt"></i>
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $shoessliders->firstItem() }} {{ __('to') }} {{ $shoessliders->lastItem() }}
                    {{ __('of') }} {{ $shoessliders->total() }} {{ __('entries') }}

                </div>
                <div class="col-12 pagination-nav pr-3"> {{ $shoessliders->links() }}</div>
            </div>
        </div>
    </div>
</div>
