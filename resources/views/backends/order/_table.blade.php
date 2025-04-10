<div class="table-wrapper p-0">
    <table id="bookingTable" class="table align-items-center table-responsive mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">{{ __('SL') }}</th>
                <th class="text-uppercase text-secondary text-sm font-weight-bolder px-2 opacity-7">{{ __('Order ID') }}</th>
                <th class="text-uppercase text-secondary text-sm font-weight-bolder px-2 opacity-7">{{ __('Customer Name') }}</th>
                <th class="text-uppercase text-secondary text-sm font-weight-bolder px-2 opacity-7">{{ __('Delivery Fee') }}</th>
                <th class="text-uppercase text-secondary text-sm font-weight-bolder px-2 opacity-7">{{ __('Total Qty') }}</th>
                <th class="text-uppercase text-secondary text-sm font-weight-bolder px-2 opacity-7">{{ __('Total Discount') }}</th>
                <th class="text-uppercase text-secondary text-sm font-weight-bolder px-2 opacity-7">{{ __('Total Order Amount') }}</th>
                <th class="text-uppercase text-secondary text-sm font-weight-bolder px-2 opacity-7">{{ __('Payment Method') }}</th>
                <th class="text-uppercase text-secondary text-sm font-weight-bolder px-2 opacity-7">{{ __('Payment Status') }}</th>
                <th class="text-uppercase text-secondary text-sm font-weight-bolder px-2 opacity-7">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $item)
                <tr>
                    <td>
                        <p class="text-sm font-weight-bold mb-0"> {{ $loop->iteration }} </p>
                    </td>
                    <td data-order="{{ strtolower(@$item->invoice_ref) }}">
                        <p class="text-sm font-weight-bold mb-0"> {{ $item->invoice_ref }} </p>
                    </td>
                    <td data-order="{{ strtolower(@$item->customer->name) }}">
                        <p class="text-sm font-weight-bold mb-0"> {{ @$item->customer->name }} </p>
                    </td>
                    <td>
                        <p class="text-sm font-weight-bold mb-0"> $ {{ $item->delivery_fee ?? 0 }} </p>
                    </td>
                    <td>
                        <p class="text-sm font-weight-bold mb-0"> {{ $item->details->sum('product_qty') }} </p>
                    </td>
                    <td>
                        <p class="text-sm font-weight-bold mb-0"> $ {{ $item->discount_amount }} </p>
                    </td>
                    <td>
                        <p class="text-sm font-weight-bold mb-0"> $ {{ number_format($item->order_amount - $item->discount_amount + $item->delivery_fee, 2) }} </p>
                    </td>
                    <td>
                        <p class="text-sm font-weight-bold mb-0 text-uppercase"> {{ ucwords(str_replace('_', ' ', $item->payment_method)) }} </p>
                    </td>
                    <td>
                        <p class="text-sm font-weight-bold mb-0">
                            @if ($item->payment_status == 'unpaid')
                                <span class="badge bg-gradient-danger"> {{ ucwords($item->payment_status) }} </span>
                            @else
                                <span class="badge bg-gradient-success"> {{ ucwords($item->payment_status) }} </span>
                            @endif
                        </p>
                    </td>
                    <td class="align-middle">
                        <a href="{{ route('admin.order.show', $item->id) }}" class="text-primary font-weight-bold text-xs btn-modal btn-edit pe-1">
                            {{ __('View') }}
                        </a>
                        <button class="btn btn-link text-danger text-sm mb-0 px-0 ms-4">
                            <i class="fas fa-file-pdf text-lg me-1"></i>
                            {{ __('PDF') }}
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center data-not-available" style="background-color: ghostwhite">
                        {{ __('Transactions are not available.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
