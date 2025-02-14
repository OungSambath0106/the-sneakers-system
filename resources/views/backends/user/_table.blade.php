<div class="table-wrapper table-responsive">
    <table id="bookingTable" class="table table-striped" style="white-space: nowrap;">
        <thead class="text-uppercase">
            <tr>
                <th>{{ __('Username') }}</th>
                <th>{{ __('Gender') }}</th>
                <th>{{ __('Phone') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Created date') }}</th>
                @if (auth()->user()->can('user.edit'))
                <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>
                        <img src="
                            @if ($user->image && file_exists(public_path('uploads/users/' . $user->image)))
                                {{ asset('uploads/users/'. $user->image) }}
                            @else
                                {{ asset('uploads/man.png') }}
                            @endif
                            " alt="" class="profile_img_table rounded-circle mr-3" style="object-fit: cover; cursor: pointer;"
                            data-toggle="modal" data-target="#imageModal" onclick="showImageModal(this)">
                        {{ @$user->first_name }} {{ @$user->last_name ?? 'N/A' }}
                    </td>
                    <td>{{ ucfirst(@$user->gender ?? 'N/A') }}</td>
                    <td>{{ @$user->phone ?? 'N/A' }}</td>
                    <td>{{ @$user->email ?? 'N/A' }}</td>
                    <td>{{ $user->created_at->format('d M Y h:i A') }}</td>
                    <td>
                        @if (auth()->user()->can('user.edit'))
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info btn-sm btn-edit">
                                <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                            </a>
                        @endif
                        @if (auth()->user()->can('user.delete'))
                            <form action="{{ route('admin.user.destroy', $user->id) }}" class="d-inline-block form-delete-{{ $user->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" data-id="{{ $user->id }}" data-username="{{ @$user->first_name }} {{ @$user->last_name ?? 'N/A' }}"
                                    data-href="{{ route('admin.user.destroy', $user->id) }}" class="btn btn-danger btn-sm btn-delete" title="Delete">
                                    <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                                </button>
                            </form>
                        @endif

                        @if (!auth()->user()->can('user.edit') && !auth()->user()->can('user.delete'))
                            <span class="text-muted">No Actions</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ auth()->user()->can('user.edit') || auth()->user()->can('user.delete') ? 6 : 5 }}" class="text-center" style="background-color: ghostwhite">
                        {{ __('Users are not available.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
