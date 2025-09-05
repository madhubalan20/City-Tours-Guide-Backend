<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">State</li>
                {{-- <li>
                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#inputFormModal">Add State </button>
                </li> --}}
            </ol>
        </nav>
    </div>
    @include('livewire.modals.state.add-state')
    @include('livewire.modals.state.edit-state')

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>Status</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($stateList as $list)
                            @php
                                $country_name = App\Models\Country::where('id', $list->country_id)->first();
                            @endphp
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $country_name->name }}</td>
                                <td>{{ $list->name }}</td>
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
                                        data-bs-target="#editState" style="cursor: pointer;">
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
