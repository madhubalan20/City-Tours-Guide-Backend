<style>
    .widget-one_hybrid.widget-referral1 .widget-heading .w-icon {
        color: #096d94;
        background-color: #cfe7f1;
    }

    .widget-one_hybrid.widget-member .widget-heading .w-icon {
        color: #0ae9e9;
        background-color: #e1eff5;
    }
</style>
<div class="middle-content container-xxl p-0">

    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row widget-statistic">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                    <div class="widget widget-one_hybrid widget-member">
                        <div class="widget-heading">
                            <div class="w-title">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                </div>
                                <div class="">
                                    <h5 class="">Total User</h5>
                                    <h5 class="w-value">{{ count($usercount) }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                    <div class="widget widget-one_hybrid widget-engagement">
                        <div class="widget-heading">
                            <div class="w-title">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-user-check">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="8.5" cy="7" r="4"></circle>
                                        <polyline points="17 11 19 13 23 9"></polyline>
                                    </svg>
                                </div>

                                <div class="">
                                    <h5 class="">Active User</h5>
                                    <h5 class="w-value">{{ count($activeusercount) }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                    <div class="widget widget-one_hybrid widget-referral1">
                        <div class="widget-heading">
                            <div class="w-title">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-link">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                    </svg>
                                </div>

                                <div class="">
                                    <h5 class="">Delete Accounts</h5>
                                    <h5 class="w-value">{{ count($deleteaccountcount) }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                    <div class="widget widget-one_hybrid widget-referral">
                        <div class="widget-heading">
                            <div class="w-title">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-file-text">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                </div>
                                <div class="">
                                    <h5 class="">Total Purchase</h5>
                                    <h5 class="w-value">{{ count($ordercount) }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-table-two p-3">

                <div class="widget-heading" style="display: flex; align-items:center; justify-content:space-between;">
                    <h5 class="">
                        Top Users
                    </h5>
                    <div>
                        <a href="{{ route('users.list') }}" class="btn btn-outline-dark float-right">View All</a>
                    </div>
                </div>

                <div class="widget-content mt-2">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>
                                        <div class="th-content">Name</div>
                                    </th>
                                    <th>
                                        <div class="th-content">Mobile No</div>
                                    </th>
                                    <th>
                                        <div class="th-content">Email Id</div>
                                    </th>
                                    <th>
                                        <div class="th-content th-heading">Total Purchase</div>
                                    </th>
                                    <th>
                                        <div class="th-content">Date Of Joining</div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($topusers) > 0)
                                    @foreach ($topusers as $user_list)
                                        <tr class="text-center">
                                            @php
                                                $user = App\Models\User::where('id', $user_list->user_id)->first();
                                            @endphp

                                            <td>
                                                <div class="td-content">{{ $user->name }}</div>
                                            </td>
                                            <td>
                                                <div class="td-content">{{ $user->mobile_no }}</div>
                                            </td>
                                            <td>
                                                <div class="td-content">{{ $user->email }}</div>
                                            </td>
                                            <td>
                                                <div class="td-content">{{ $user_list->total_orders }}</div>
                                            </td>
                                            <td>
                                                <div class="td-content">{{ $user->created_at->format('d/m/Y') }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="5">
                                            <div class="td-content">No data found</div>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-table-two p-3">

                <div class="widget-heading" style="display: flex; align-items:center; justify-content:space-between;">
                    <h5 class="">
                        Top Selling Tours
                    </h5>
                    <div>
                        <a href="{{ route('tour_place.list') }}" class="btn btn-outline-dark float-right">View All</a>
                    </div>
                </div>

                <div class="widget-content mt-2">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>
                                        <div class="th-content">Tour Name</div>
                                    </th>
                                    <th>
                                        <div class="th-content">City Name</div>
                                    </th>
                                    <th>
                                        <div class="th-content">State Name</div>
                                    </th>
                                    <th>
                                        <div class="th-content th-heading">Country Name</div>
                                    </th>
                                    <th>
                                        <div class="th-content">Sale Count</div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($topsellingtour) > 0)
                                    @foreach ($topsellingtour as $tour_list)
                                        <tr class="text-center">
                                            @php
                                                $tour = App\Models\PurchaseTour::where('tour_id', $tour_list->tour_id)->first();
                                            @endphp

                                            <td>
                                                <div class="td-content">{{ $tour->tour_name }}</div>
                                            </td>
                                            <td>
                                                <div class="td-content">{{ $tour->city_name }}</div>
                                            </td>
                                            <td>
                                                <div class="td-content">{{ $tour->state_name }}</div>
                                            </td>
                                            <td>
                                                <div class="td-content">{{ $tour->country_name }}</div>
                                            </td>
                                            <td>
                                                <div class="td-content">{{ $tour_list->total_tours }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="5">
                                            <div class="td-content">No data found</div>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
