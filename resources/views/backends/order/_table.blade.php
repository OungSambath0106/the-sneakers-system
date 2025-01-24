<div class="card-body p-0 table-wrapper">
    <table class="table table-striped nowrap" id="myTable">
        <thead>
            <tr>
                {{-- <th>#</th> --}}
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
            @foreach ($orders as $item)
                <tr>
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>#{{ $item->id }}</td>
                    <td>{{ $item->customer->first_name }} {{ $item->customer->last_name }}</td>
                    <td>$ {{ $item->order_amount }}</td>
                    <td>$ {{ $item->discount_amount }}</td>
                    <td>$ {{ $item->shipping_fee }}</td>
                    <td>$ {{ $item->order_amount }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $item->payment_method)) }}</td>
                    <td>{{ ucwords($item->payment_status) }}</td>
                    <td>
                        <a href="{{ route('admin.order.edit', $item->id) }}" class="btn btn-info btn-sm btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>
                    </td>
                </tr>
            @endforeach
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
