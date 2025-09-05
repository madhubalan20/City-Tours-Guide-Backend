<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">City</li>
                <li>
                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#inputFormModal">Add City</button>
                </li>
            </ol>
        </nav>
    </div>
    @include('livewire.modals.citydetail.add-city')
    @include('livewire.modals.citydetail.edit-city')

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Image</th>
                            <th>Recommended</th>
                            <th>Status</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($citylist as $list)
                            @php
                                $country_name = App\Models\Country::where('id', $list->country_id)->first();
                                $state_name = App\Models\State::where('id', $list->state_id)->first();
                            @endphp
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $country_name->name }}</td>
                                <td>{{ $state_name->name }}</td>
                                <td>{{ $list->name }}</td>
                                <td>
                                    <img src="{{ $list->image }}" alt="No image" height="100" width="150">
                                </td>
                                <td>
                                    <div class="form-check form-switch form-check-inline form-switch-primary">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            style="cursor: pointer;" id="socialformprofile-custom-switch-success"
                                            {{ $list->recommend_status == '1' ? 'checked' : '' }}
                                            wire:click="updateRecommendStatus($event.target.checked,'{{ $list->id }}')">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch form-check-inline form-switch-primary">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            style="cursor: pointer;" id="socialformprofile-custom-switch-success"
                                            {{ $list->status == '1' ? 'checked' : '' }}
                                            wire:click="updateStatus($event.target.checked,'{{ $list->id }}')">
                                    </div>
                                </td>
                                <td>
                                    <a class="" wire:click="edit({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#editinputFormModal" style="cursor: pointer;">
                                        <img src="{{ asset('src/assets/img/icons/edit.svg') }}" alt="img">
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

