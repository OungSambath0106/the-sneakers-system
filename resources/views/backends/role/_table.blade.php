<div class="table-wrapper p-0">
    <table id="bookingTable" class="table align-items-center table-responsive mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 px-3">#</th>
                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 px-3">{{ __('Name') }} </th>
                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @if($roles)
                @foreach ($roles as $row)
                    <tr>
                        <td>
                            <p class="text-sm font-weight-bold mb-0 px-2">{{$loop->iteration}}</p>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0 px-2">{{$row->name}}</p>
                        </td>
                        <td class="align-middle text-center">
                            @if ($row->name != 'admin')
                                @if (auth()->user()->can('role.edit'))
                                    <a href="{{route('admin.roles.edit',$row->id)}}" class="text-primary font-weight-bold text-xs btn-edit pe-1">
                                        {{ __('Edit') }}
                                    </a>
                                @endif

                                @if (auth()->user()->can('role.delete') && !in_array($row->name, ['admin', 'partner', 'customer']))
                                    <form action="{{ route('admin.roles.destroy', $row->id) }}" class="d-inline-block form-delete-{{ $row->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-id="{{ $row->id }}" data-href="{{ route('admin.roles.destroy', $row->id) }}" class="text-danger font-weight-bold text-xs btn-delete" title="Delete" style="background: none; border: none;">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach

            @endif
        </tbody>
    </table>

    @if (count($roles) != 0)
        <div class="row">
            <div class="col-12 d-flex flex-row flex-wrap">
                <div class="row" style="width: -webkit-fill-available;">
                    <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                        {{ __('Showing') }} {{ $roles->firstItem() }} {{ __('to') }} {{ $roles->lastItem() }} {{ __('of') }} {{ $roles->total() }} {{ __('entries') }}
                    </div>
                    <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $roles->links() }}</div>
                </div>
            </div>
        </div>
    @endif
</div>
