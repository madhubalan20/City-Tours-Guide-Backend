<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">Intro Banner</li>
                <li>
                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#inputFormModal">Add Intro Banner</button>
                </li>
            </ol>
        </nav>
    </div>

    @include('livewire.modals.banner.add-intro-banner')
    @include('livewire.modals.banner.edit-intro-banner')
    @include('livewire.modals.banner.delete-intro-banner')


    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($introbanner as $list)
                            @php
                                $description = wordwrap($list->description, 40, '<br>');
                            @endphp
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $list->title }}</td>
                                <td class="text-limited">
                                    {!! $description !!}
                                </td>
                                <td>
                                    <img src="{{ $list->image }}" alt="No image" height="150" width="100">
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
                                    <a class="me-2" wire:click="editIntroBanner({{ $list->id }})"
                                        data-bs-toggle="modal" data-bs-target="#editIntroBanner" style="cursor: pointer;">
                                        <img src="{{ asset('src/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>
                                    <a wire:click="getDeleteIntroBanner({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteIntroBanner" style="cursor: pointer;">
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
