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

                <li class="breadcrumb-item active" aria-current="page">Tour Places Details</li>
                <li>
                    <a href="{{ route('tour_place.list') }}">
                        <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                            data-bs-toggle="modal" data-bs-target="#inputFormModal">Back</button>
                    </a>
                </li>
            </ol>
        </nav>
    </div>

    @include('livewire.modals.tourplace.add-image')
    @include('livewire.modals.tourplace.edit-image')
    @include('livewire.modals.tourplace.delete-image')
    @include('livewire.modals.tourplace.add-video')
    @include('livewire.modals.tourplace.edit-video')
    @include('livewire.modals.tourplace.delete-video')


    {{-- @include('livewire.modals.tourplace.delete-video') --}}


    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <div class="container">
                    <div class="pt-3 ps-2 pe-2 pb-4">
                        <div class="row">
                            <div class="form-group col-sm-6 mb-3">
                                <label>Country</label>
                                <input type="text" name="name" value="{{ $country->name }}" class="form-control"
                                    style="color: black" readonly>
                            </div>

                            <div class="form-group col-sm-6 mb-3">
                                <label>State</label>
                                <input type="text" name="name" value="{{ $state->name }}" class="form-control"
                                    style="color: black" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 mb-3">
                                <label>City</label>
                                <input type="text" name="name" value="{{ $city->name }}" class="form-control"
                                    style="color: black" readonly>
                            </div>

                            <div class="form-group col-sm-6 mb-3">
                                <label>Title</label>
                                <input type="text" name="name" value="{{ $tourdetails->title }}"
                                    class="form-control" style="color: black" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 mb-3">
                                <label>Duration Time</label>
                                <input type="text" name="name" value="{{ $tourdetails->duration_time }}"
                                    class="form-control" style="color: black" readonly>
                            </div>

                            <div class="form-group col-sm-6 mb-3">
                                <label>Tour Audio Points</label>
                                <input type="text" name="name" value="{{ $tourdetails->audio_point }}"
                                    class="form-control" style="color: black" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 mb-3">
                                <label>Tour Stops</label>
                                <input type="text" name="name" value="{{ $tourdetails->tour_stops }}"
                                    class="form-control" style="color: black" readonly>
                            </div>

                            <div class="form-group col-sm-6 mb-3">
                                <label>Demo Price</label>
                                <input type="text" name="name" value="{{ $tourdetails->demo_price }}"
                                    class="form-control" style="color: black" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 mb-3">
                                <label>Offer Percentage</label>
                                <input type="text" name="name"
                                    value="{{ $tourdetails->offer_percentage ?? '0' }}%" class="form-control"
                                    style="color: black" readonly>
                            </div>

                            <div class="form-group col-sm-6 mb-3">
                                <label>Price</label>
                                <input type="text" name="name" value="{{ $tourdetails->price }}"
                                    class="form-control" style="color: black" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 mb-3">
                                <label>Tour Type</label>
                                @if ($tourdetails->tour_type == '1')
                                    <input type="text" name="name" value="Single Tour" class="form-control"
                                        style="color: black" readonly>
                                @else
                                    <input type="text" name="name" value="Bundle Tour" class="form-control"
                                        style="color: black" readonly>
                                @endif
                            </div>

                            {{-- <div class="form-group col-sm-6 mb-3">
                                <label>Video Url</label>
                                <input type="text" name="name" value="{{ $tourdetails->price }}"
                                    class="form-control">
                            </div> --}}
                            <div class="form-group col-sm-6 mb-3">
                                <label>Json Url</label>
                                <textarea type="text" name="json_url" class="form-control" rows="1" style="color: black" readonly>{{ old('json_url', $tourdetails->json_url) }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 mb-3">
                                <label>Description</label>
                                <textarea type="text" name="description" class="form-control" style="color: black" readonly>{{ old('description', $tourdetails->description) ?? 'N/A' }}</textarea>
                            </div>

                            <div class="form-group col-sm-6 mb-3">
                                <label>Know Before You Go<< /label>
                                        <textarea type="text" name="know_before_you_go" class="form-control" style="color: black" readonly>{{ old('description', $tourdetails->know_before_you_go) ?? 'N/A' }}</textarea>
                            </div>

                            <div class="form-group col-sm-6 mb-3">
                                <label>Error Message</label>
                                <textarea type="text" name="message" class="form-control" style="color: black" readonly>{{ old('description', $tourdetails->error_message) ?? 'N/A' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <div class="ps-3 pt-3 pb-0 pe-3 "
                    style="display: flex; justify-content:space-between; align-items:center; ">
                    <h6>All Images</h6>

                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#addImage">Add Image</button>
                </div>
                <hr />
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Image</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tourimages as $list)
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td><img src="{{ $list->image }}" width="150" height="100" alt="">
                                </td>
                                <td>
                                    <a class="me-2" wire:click="editImages({{ $list->id }})"
                                        data-bs-toggle="modal" data-bs-target="#editImage" style="cursor: pointer;">
                                        <img src="{{ asset('src/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>

                                    @if ($tourimages->count() > 1)
                                        <a wire:click="getDeleteImage({{ $list->id }})" data-bs-toggle="modal"
                                            data-bs-target="#deleteImage" style="cursor: pointer;">
                                            <img src="{{ asset('src/assets/img/icons/delete.svg') }}" alt="img">
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <div class="ps-3 pt-3 pb-0 pe-3 "
                    style="display: flex; justify-content:space-between; align-items:center; ">
                    <h6>All Videos Url</h6>

                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#addVideo">Add Video</button>
                </div>
                <hr />
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Url</th>
                            <th>Video</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @if (count($tourvideos) > 0)
                            @foreach ($tourvideos as $list)
                                <tr class="text-center">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $list->video_url }}</td>
                                    <td>
                                        <a class="" data-bs-toggle="inputFormModal"
                                            href="{{ $list->video_url }}" target="_blank"><img height="30"
                                                width="30"
                                                src="{{ asset('src/assets/img/icons/play-button.png') }}"
                                                alt="img">
                                        </a>
                                    </td>
                                    <td>
                                        <a class="me-2" wire:click="editVideo({{ $list->id }})"
                                            data-bs-toggle="modal" data-bs-target="#editVideo"
                                            style="cursor: pointer;">
                                            <img src="{{ asset('src/assets/img/icons/edit.svg') }}" alt="img">
                                        </a>
                                        <a wire:click="getDeleteVideo({{ $list->id }})" data-bs-toggle="modal"
                                            data-bs-target="#deleteVideo" style="cursor: pointer;">
                                            <img src="{{ asset('src/assets/img/icons/delete.svg') }}" alt="img">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td colspan="3">No data found</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
