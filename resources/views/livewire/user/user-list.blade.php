<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">All Users</li>
                {{-- <li>
                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#inputFormModal">Add State </button>
                </li> --}}
            </ol>
        </nav>
    </div>

    @include('livewire.modals.user.user.view-user')
    @include('livewire.modals.user.user.delete-user')
    @include('livewire.modals.user.user.add-notification')


    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Otp</th>
                            {{-- <th>Mobile No</th>
                            <th>Date Of Joining</th>
                            <th>Total Purchase</th> --}}
                            <th>Verify Status</th>
                            <th>Active Status</th>
                            <th>Delete Account Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($userList as $list)
                            @php
                                $order_count = App\Models\Order::where([
                                    ['user_id', $list->id],
                                    ['payment_status', '1'],
                                ])->count();
                            @endphp
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <a href="{{ route('user-purchase-history', ['id' => $list->id]) }}">
                                        <span class="badge badge-light-secondary mb-2 me-4">{{ $list->name }}</span>
                                    </a>
                                </td>
                                <td>{{ $list->email }}</td>
                                <td>{{ $list->verify_code }}</td>
                                {{-- <td>{{ $list->mobile_no }}</td>
                                <td>{{ $list->created_at->format('d/m/Y') }}</td>
                                <td>{{ $order_count }}</td> --}}
                                <td>
                                    @if ($list->verify_status == '1')
                                        <span class="badge badge-light-success mb-2 me-4">Verified</span>
                                    @else
                                        <span class="badge badge-light-danger mb-2 me-4">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($list->active_status == '1')
                                        <span class="badge badge-light-success mb-2 me-4">Active</span>
                                    @else
                                        <span class="badge badge-light-danger mb-2 me-4">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check form-switch form-check-inline form-switch-primary">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            style="cursor: pointer;" id="socialformprofile-custom-switch-success"
                                            {{ $list->delete_account_status == '0' ? 'checked' : '' }}
                                            wire:click="updateDeleteStatus($event.target.checked,'{{ $list->id }}')">
                                    </div>
                                </td>

                                <td>
                                    <a class="me-1" data-bs-toggle="modal" data-bs-target="#viewUserDetails"
                                        wire:click="viewUser({{ $list->id }})" style="cursor: pointer"><img
                                            src="{{ asset('src/assets/img/icons/eye.svg') }}" alt="img">
                                    </a>
                                    {{-- <a class="me-3" data-bs-toggle="modal" data-bs-target="#addNotification"
                                        wire:click="getUser({{ $list->id }})" style="cursor: pointer"><img
                                            src="{{ asset('src/assets/img/icons/eye.svg') }}" alt="img">
                                    </a> --}}
                                    <svg class="me-1"data-bs-toggle="modal" data-bs-target="#addNotification"
                                        wire:click="getUser({{ $list->id }})" style="cursor: pointer"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                    </svg>
                                    <a wire:click="getDeleteUser({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteUser" style="cursor: pointer;">
                                        <img src="{{ asset('src/assets/img/icons/delete.svg') }}" alt="img">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
