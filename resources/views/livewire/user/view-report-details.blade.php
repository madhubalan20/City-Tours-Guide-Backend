<div>

    <style>
        .form-control:disabled:not(.flatpickr-input),
        .form-control[readonly]:not(.flatpickr-input) {
            background-color: transparent;
            cursor: no-drop;
            color: #515365;
        }

        .image-style {
            height: 100%;
            width: 100%;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
    </style>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">User Report Details</li>
                <li>
                    <a href="{{ route('user.reports') }}">
                        <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                            data-bs-toggle="modal" data-bs-target="#inputFormModal">Back</button>
                    </a>
                </li>
            </ol>
        </nav>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <div class="container">
                    <div class="pt-3 ps-2 pe-2 pb-4">
                        @php
                            $user = App\Models\User::where('id', $userReports->user_id)->first();
                        @endphp
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-4 mb-3">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                    readonly>
                            </div>

                            <div class="form-group col-sm-6 col-md-4 mb-3">
                                <label>Email</label>
                                <input type="text" name="name" value="{{ $user->email }}" class="form-control"
                                    readonly>

                            </div>

                            <div class="form-group col-sm-6 col-md-4 mb-3">
                                <label>Mobile No</label>
                                <input type="text" name="name" value="{{ $user->mobile_no }}" class="form-control"
                                    readonly>

                            </div>

                            <div class="form-group col-sm-6 col-md-4 mb-3">
                                <label>Date</label>
                                <input type="text" name="name"
                                    value="{{ \Carbon\Carbon::parse($userReports->create_date)->format('d/m/Y') }}"
                                    class="form-control" readonly>
                            </div>

                            <div class="form-group col-sm-6 col-md-4 mb-3">
                                <label>Report Type</label>
                                <input type="text" name="name"
                                    value="{{ $userReports->type == '1' ? 'Tour' : 'App' }}" class="form-control"
                                    readonly>
                            </div>

                            <div class="form-group col-sm-6 col-md-4 mb-3">
                                <label>Tour</label>
                                <input type="text" name="name" value="{{ $userReports->tour_name ?? 'None' }}"
                                    class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4 mb-3">
                                <label>Problem Type</label>
                                <input type="text" name="name" value="{{ $userReports->problem_type }}"
                                    class="form-control" readonly>

                            </div>

                            <div class="form-group col-md-8 mb-3">
                                <label>Description</label>
                                <input type="text" name="name" value="{{ $userReports->description ?? 'None' }}"
                                    class="form-control" readonly>

                            </div>
                        </div>

                        @if(count($userReportsImage) > 0)
                            <div class="row">
                                <label>Images</label>
                                @foreach ($userReportsImage as $list)
                                    <div class="form-group col-sm-6 col-md-4 mb-3 text-center">
                                        <img src="{{ $list->image }}" style="height: 70%; width:70%" alt="No Image"
                                            class="image-style">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
