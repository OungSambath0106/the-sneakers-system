{{-- <div class="table-wrapper table-responsive">
    <table id="bookingTable" class="table table-striped" style="white-space: nowrap;">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Created By') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($brands as $brand)
                <tr>
                    <td data-order="{{ strtolower($brand->name) }}">
                        <img src="
                            @if ($brand->image && file_exists(public_path('uploads/brand/' . $brand->image)))
                                {{ asset('uploads/brand/'. $brand->image) }}
                            @else
                                {{ asset('uploads/defualt.png') }}
                            @endif
                            " alt="" class="profile_img_table mr-3" style="object-fit: contain; cursor: pointer;"
                            data-toggle="modal" data-target="#imageModal" onclick="showImageModal(this)">
                            {{ $brand->name }}
                    </td>
                    <td>{{ $brand->createdBy->name }}</td>
                    <td>
                        <div class="ckbx-style-9 mt-2">
                            <input type="checkbox" class="status"
                                id="status_{{ $brand->id }}" data-id="{{ $brand->id }}"
                                {{ $brand->status == 1 ? 'checked' : '' }} name="status">
                            <label for="status_{{ $brand->id }}"></label>
                        </div>
                    </td>
                    <td>
                        @if (auth()->user()->can('brand.edit'))
                            <a href="#" data-href="{{ route('admin.brand.edit', $brand->id) }}"
                                class="btn btn-info btn-sm btn-modal btn-edit" data-toggle="modal" data-container=".modal_form">
                                <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                            </a>
                        @endif
                        @if (auth()->user()->can('brand.delete'))
                            <form action="{{ route('admin.brand.destroy', $brand->id) }}" class="d-inline-block form-delete-{{ $brand->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" data-id="{{ $brand->id }}"  data-href="{{ route('admin.brand.destroy', $brand->id) }}" class="btn btn-danger btn-sm btn-delete" title="Delete">
                                    <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                                </button>
                            </form>
                        @endif

                        @if (!auth()->user()->can('brand.edit') && !auth()->user()->can('brand.delete'))
                            <span class="text-muted">No Actions</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ auth()->user()->can('brand.edit') || auth()->user()->can('brand.delete') ? 6 : 5 }}" class="text-center" style="background-color: ghostwhite">
                        {{ __('Brands are not available.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div> --}}
<div class="table-wrapper p-0">
    <table id="bookingTable" class="table align-items-center table-responsive mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> {{ __('Name') }} </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"> {{ __('Created By') }} </th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> {{ __('Status') }} </th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> {{ __('Action') }} </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($brands as $brand)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <img src="
                                @if ($brand->image && file_exists(public_path('uploads/brand/' . $brand->image)))
                                    {{ asset('uploads/brand/'. $brand->image) }}
                                @else
                                    {{ asset('uploads/defualt.png') }}
                                @endif
                                " alt="" class="avatar avatar-sm me-3" style="object-fit: contain; cursor: pointer;"
                                data-toggle="modal" data-target="#imageModal" onclick="showImageModal(this)">
                            <p class="mb-0 text-xs font-weight-bold align-content-center">{{ $brand->name }}</p>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $brand->createdBy->name }}</p>
                    </td>
                    <td class="align-middle text-center text-sm" style="justify-items: center;">
                        <div class="ckbx-style-9 mt-2">
                            <input type="checkbox" class="status"
                                id="status_{{ $brand->id }}" data-id="{{ $brand->id }}"
                                {{ $brand->status == 1 ? 'checked' : '' }} name="status">
                            <label for="status_{{ $brand->id }}"></label>
                        </div>
                    </td>
                    <td class="align-middle text-center">
                        @if (auth()->user()->can('brand.edit'))
                            <a href="#" data-href="{{ route('admin.brand.edit', $brand->id) }}"
                                class="text-secondary font-weight-bold text-xs btn-modal btn-edit pe-1" data-toggle="modal" data-container=".modal_form">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        @endif

                        @if (auth()->user()->can('brand.delete'))
                            <form action="{{ route('admin.brand.destroy', $brand->id) }}" class="d-inline-block form-delete-{{ $brand->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" data-id="{{ $brand->id }}" data-href="{{ route('admin.brand.destroy', $brand->id) }}" class="text-secondary font-weight-bold text-xs btn-delete" title="Delete" style="background: none; border: none;">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        @endif

                        @if (!auth()->user()->can('brand.edit') && !auth()->user()->can('brand.delete'))
                            <span class="text-muted">No Actions</span>
                        @endif
                    </td>
                </tr>
            @empty
                <td colspan="{{ auth()->user()->can('brand.edit') || auth()->user()->can('brand.delete') ? 6 : 5 }}" class="text-center" style="background-color: ghostwhite">
                    {{ __('Brands are not available.') }}
                </td>
            @endforelse
        </tbody>
    </table>
</div>
