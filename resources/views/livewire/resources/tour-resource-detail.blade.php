<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">Tour Resource</li>
                <li>
                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#addTourResource">Add Tour Resource</button>
                </li>
            </ol>
        </nav>
    </div>
    @include('livewire.modals.resources.add-tour-resource')
    @include('livewire.modals.resources.edit-tour-resource')
    @include('livewire.modals.resources.delete-tour-resource')

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Tour Name</th>
                            <th>Title</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tourresource as $list)
                            @php
                                $tour_name = App\Models\TourPlace::where('id', $list->tour_id)->first();
                                $url =  wordwrap($list->url, 40, '<br>', true);
                            @endphp
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $tour_name->title }}</td>
                                <td>{{ $list->title }}</td>
                                <td class="text-limited">
                                    {!! $url !!}
                                </td>
                                <td>
                                    <img src="{{ $list->image }}" alt="No image" height="50" width="50">
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
                                    <a class="" wire:click="editTourResource({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#editTourResource" style="cursor: pointer;">
                                        <img src="{{ asset('src/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>
                                    <a wire:click="getDeleteTourResource({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteTourResource" style="cursor: pointer;">
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



