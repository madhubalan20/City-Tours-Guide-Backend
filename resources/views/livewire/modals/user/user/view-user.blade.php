<div wire:ignore.self class="modal fade inputForm-modal" id="viewUserDetails" tabindex="-1" role="document"
    aria-labelledby="inputFormModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">View <b>Details</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('users.list') }}">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </a>
                </button>
            </div>

            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 layout-top-spacing">

                    <div class="usr-tasks ">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>Name</b></td>
                                            <td>{{ $user_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td>{{ $user_email ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Mobile No</b></td>
                                            <td>{{ $user_mobile_no ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Date Of Joining</b></td>
                                            <td>{{ \Carbon\Carbon::parse($user_create_date)->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Active Status</b></td>
                                            <td>{{ $user_active_status == '1' ? 'Active' : 'Deactive' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Verify Status</b></td>
                                            <td>{{ $user_verify_status == '1' ? 'Verified' : 'Pending' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Delete Account Status</b></td>
                                            <td>{{ $user_delete_account_status == '1' ? 'Active' : 'Delete' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Total Purchase</b></td>
                                            <td>{{ $order_count ?? '0' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Device Id</b></td>
                                            <td>{{ $device_id ?? 'N/A' }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>One Signal Id</b></td>
                                            <td>{{ $one_signal_id ?? 'N/A' }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Push Token</b></td>
                                            <td>{{ $push_token ?? 'N/A'}}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Device Brand</b></td>
                                            <td>{{ $device_brand ?? 'N/A'}}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Device Model</b></td>
                                            <td>{{ $device_model ?? 'N/A'}}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Device SDK</b></td>
                                            <td>{{ $device_SDK ?? 'N/A'}}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Device Manufacture</b></td>
                                            <td>{{ $device_manufacture ?? 'N/A'}}</td>
                                        </tr>

                                        <tr>
                                            <td><b>App Release</b></td>
                                            <td>{{ $app_release ?? 'N/A'}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .layout-top-spacing {
            margin-top: 0px;
        }
    </style>
</div>
