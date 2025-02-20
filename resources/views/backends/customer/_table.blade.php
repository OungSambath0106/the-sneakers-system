<div class="table-wrapper table-responsive">
    <table id="bookingTable" class="table table-striped" style="white-space: nowrap;">
        <thead class="text-uppercase">
            <tr>
                <th>{{ __('Customer Name') }}</th>
                <th>{{ __('Gender') }}</th>
                <th>{{ __('Phone') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Created date') }}</th>
                <th>{{ __('Status') }}</th>
                @if (auth()->user()->can('customer.edit'))
                <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td data-order="{{ strtolower(@$customer->first_name) . ' ' . strtolower(@$customer->last_name) }}">
                        <img src="
                        @if ($customer->image && file_exists(public_path('uploads/customers/' . $customer->image)))
                            {{ asset('uploads/customers/'. $customer->image) }}
                        @elseif ($customer->gender=='male')
                            {{ asset('uploads/man.png') }}
                        @elseif ($customer->gender=='female')
                            {{ asset('uploads/woman.png') }}
                        @endif
                        " alt="" class="profile_img_table rounded-circle mr-3" style="object-fit: cover; cursor: pointer;"
                        data-toggle="modal" data-target="#imageModal" onclick="showImageModal(this)">
                        {{ @$customer->first_name }} {{ @$customer->last_name ?? 'N/A' }}
                    </td>
                    <td>{{ ucfirst(@$customer->gender ?? 'N/A') }}</td>
                    <td>{{ $customer->phone ?? 'N/A' }}</td>
                    <td data-order="{{ strtolower(@$customer->email) }}">
                        {{ @$customer->email ?? 'N/A' }}
                    </td>
                    <td data-order="{{ $customer->created_at->timestamp }}">
                        {{ $customer->created_at->format('d M Y h:i A') }}
                    </td>
                    <td data-order="{{ $customer->status }}">
                        <div class="ckbx-style-9 mt-2">
                            <input type="checkbox" class="status"
                                id="status_{{ $customer->id }}" data-id="{{ $customer->id }}"
                                {{ $customer->status == 1 ? 'checked' : '' }} name="status">
                            <label for="status_{{ $customer->id }}"></label>
                        </div>
                    </td>
                    <td>
                        @if (auth()->user()->can('customer.edit'))
                            <a href="{{ route('admin.customer.edit', $customer->id) }}" class="btn btn-info btn-sm btn-edit">
                                <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                            </a>
                        @endif
                        @if (auth()->user()->can('customer.delete'))
                            <form action="{{ route('admin.customer.destroy', $customer->id) }}" class="d-inline-block form-delete-{{ $customer->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" data-id="{{ $customer->id }}" data-username="{{ @$customer->first_name }} {{ @$customer->last_name ?? 'N/A' }}"
                                    data-href="{{ route('admin.customer.destroy', $customer->id) }}" class="btn btn-danger btn-sm btn-delete" title="Delete">
                                    <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                                </button>
                            </form>
                        @endif

                        @if (!auth()->user()->can('customer.edit') && !auth()->user()->can('customer.delete'))
                            <span class="text-muted">No Actions</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ auth()->user()->can('customer.edit') || auth()->user()->can('customer.delete') ? 7 : 6 }}" class="text-center" style="background-color: ghostwhite">
                        {{ __('Customers are not available.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
