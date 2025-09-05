<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">All Reports</li>
            </ol>
        </nav>
    </div>

    @include('livewire.modals.user.report.delete-report')

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Report Type</th>
                            <th>Problem Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($userReports as $list)
                            @php
                                $user = App\Models\User::where('id', $list->user_id)->first();
                            @endphp
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <a href="{{ route('user-purchase-history', ['id' => $user->id]) }}">
                                        <span class="badge badge-light-secondary mb-2 me-4">{{ $user->name }}</span>
                                    </a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $list->type == '1' ? 'Tour' : 'App' }}</td>
                                <td>{{ $list->problem_type }}</td>
                                <td>{{ \Carbon\Carbon::parse($list->create_date)->format('d/m/Y') }}</td>

                                <td>
                                    <a class="me-3" data-bs-toggle="inputFormModal"
                                        href="{{ route('view.report.details', ['id' => $list->id]) }}"><img
                                            src="{{ asset('src/assets/img/icons/eye.svg') }}" alt="img">
                                    </a>

                                    <a wire:click="getDeleteReport({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteReport" style="cursor: pointer;">
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
