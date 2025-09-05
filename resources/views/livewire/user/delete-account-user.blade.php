<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">Delete Account Users</li>
                {{-- <li>
                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#inputFormModal">Add State </button>
                </li> --}}
            </ol>
        </nav>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Date Of Joining</th>
                            <th>Total Purchase</th>
                            <th>Delete Account Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($userList as $list)

                        @php
                            $order_count = App\Models\Order::where([['user_id', $list->id],['payment_status', '1']])->count();
                        @endphp
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <a href="{{ route('user-purchase-history', ['id' => $list->id]) }}">
                                        <span class="badge badge-light-secondary mb-2 me-4">{{ $list->name }}</span>
                                    </a>
                                </td>
                                <td>{{ $list->email }}</td>
                                <td>{{ $list->mobile_no }}</td>
                                <td>{{ $list->created_at->format('d/m/Y') }}</td>
                                <td>{{ $order_count }}</td>
                                
                                <td>
                                    <div class="form-check form-switch form-check-inline form-switch-primary">
                                        <input class="form-check-input" type="checkbox" role="switch" style="cursor: pointer;"
                                            id="socialformprofile-custom-switch-success"
                                            {{ $list->delete_account_status == '0' ? 'checked' : '' }}
                                            wire:click="updateDeleteStatus($event.target.checked,'{{ $list->id }}')">
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

