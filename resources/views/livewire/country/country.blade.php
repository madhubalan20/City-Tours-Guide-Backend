<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">
                <li class="breadcrumb-item active" aria-current="page">Country</li>
                {{-- <li>
                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#inputFormModal">Add Country</button>
                </li> --}}
            </ol>
        </nav>
    </div>
    @include('livewire.modals.country.add-country')
    @include('livewire.modals.country.edit-country')

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                
                            @foreach ($countrylist as $list)
                                <tr class="text-center">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>
                                        <div class="form-check form-switch form-check-inline form-switch-primary">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="socialformprofile-custom-switch-success" style="cursor: pointer;"
                                                {{ $list->status == '1' ? 'checked' : '' }}
                                                wire:click="updateStatus($event.target.checked,'{{ $list->id }}')">
                                        </div>
                                    </td>
                                    <td>
                                        <a class="" wire:click="edit({{ $list->id }})"
                                            data-bs-toggle="modal" data-bs-target="#editCountry" style="cursor: pointer;">
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

