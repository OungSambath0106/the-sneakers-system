<div class="card-body p-0 table-wrapper">
    <table class="table table-striped nowrap" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Order ID') }}</th>
                <th>{{ __('Customer Name') }}</th>
                <th>{{ __('Total Product Amount	') }}</th>
                <th>{{ __('Product Discount') }}</th>
                <th>{{ __('Shipping Charge') }}</th>
                <th>{{ __('Order Amount') }}</th>
                <th>{{ __('Payment Method') }}</th>
                <th>{{ __('Payment Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($orders as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        <img width="30%" height="auto" src="
                        @if ($item->image && file_exists(public_path('uploads/onboards/' . $item->image))) {{ asset('uploads/onboards/' . $item->image) }}
                        @else
                            {{ asset('uploads/image/default.png') }} @endif
                        "
                            alt="" class="profile_img_table">
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
                        <a href="{{ route('admin.onboard.edit', $item->id) }}" class="btn btn-info btn-sm btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('admin.onboard.destroy', $item->id) }}"
                            class="d-inline-block form-delete-{{ $item->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $item->id }}"
                                data-href="{{ route('admin.onboard.destroy', $item->id) }}"
                                class="btn btn-danger btn-sm btn-delete">
                                <i class="fa fa-trash-alt"></i>
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>

    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $orders->firstItem() }} {{ __('to') }} {{ $orders->lastItem() }}
                    {{ __('of') }} {{ $orders->total() }} {{ __('entries') }}

                </div>
                <div class="col-12 pagination-nav pr-3"> {{ $orders->links() }}</div>
            </div>
        </div>
    </div>
</div>
