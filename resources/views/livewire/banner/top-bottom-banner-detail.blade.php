<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">Top & Bottom Banner</li>
                <li>
                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#inputFormModal">Add Banner</button>
                </li>
            </ol>
        </nav>
    </div>

    @include('livewire.modals.banner.add-banner')
    @include('livewire.modals.banner.edit-banner')
    @include('livewire.modals.banner.delete-banner')


    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Arrangement</th>
                            <th>Position</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>View Detail</th>
                            <th>Status</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($banner as $list)
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $list->arrangement }}</td>

                                <td>
                                    @if ($list->position == 1)
                                        Top
                                    @else
                                        Bottom
                                    @endif
                                </td>
                                <td>{{ $list->title }}</td>

                                @if ($list->image)
                                    <td> <img src="{{ $list->image }}" alt="No image" height="180" width="170">
                                    </td>
                                @else
                                    <td>
                                        <a class="me-3" data-bs-toggle="inputFormModal" href="{{ $list->url }}"
                                            target="_blank"><img height="30" width="30"
                                                src="{{ asset('src/assets/img/icons/play-button.png') }}"
                                                alt="img">
                                        </a>
                                    </td>
                                @endif

                                <td>
                                    <a class="me-3" data-bs-toggle="inputFormModal"
                                        href="{{ route('banner.detail', ['id' => $list->id]) }}"><img
                                            src="{{ asset('src/assets/img/icons/eye.svg') }}" alt="img">
                                    </a>
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
                                    <a class="me-2" wire:click="editBanner({{ $list->id }})"
                                        data-bs-toggle="modal" data-bs-target="#editBanner" style="cursor: pointer;">
                                        <img src="{{ asset('src/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>
                                    <a wire:click="getDeleteBanner({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteBanner" style="cursor: pointer;">
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
