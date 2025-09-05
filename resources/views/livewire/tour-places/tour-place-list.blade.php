<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">Tour Places</li>
                <li>
                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#inputFormModal">Add Tour</button>
                </li>
            </ol>
        </nav>
    </div>
    @include('livewire.modals.tourplace.add-tour-place')
    @include('livewire.modals.tourplace.edit-tour-place')
    @include('livewire.modals.tourplace.delete-tour-place')
    @include('livewire.modals.tourplace.edit-json-url')
    @include('livewire.modals.tourplace.free-tour')


    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Tour</th>
                            {{-- <th>Country</th>
                            <th>State</th> --}}
                            <th>City</th>
                            <th>Preview Image</th>
                            <th>Message</th>
                            <th>Json Url</th>
                            <th>Active Status</th>
                            <th>Free Status</th>
                            <th>View More</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tourPlace as $list)
                            @php
                                $country_name = App\Models\Country::where('id', $list->country_id)->first();
                                $state_name = App\Models\State::where('id', $list->state_id)->first();
                                $city_name = App\Models\City::where('id', $list->city_id)->first();
                                $message = wordwrap($list->error_message, 40, '<br>', true);
                            @endphp
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $list->title }}</td>
                                {{-- <td>{{ $country_name->name }}</td>
                                <td>{{ $state_name->name }}</td> --}}
                                <td>{{ $city_name->name }}</td>
                                <td><img src="{{ $list->preview_image }}" width="150" height="100" alt="">
                                </td>
                                <td>
                                    @if ($list->error_message)
                                        <span
                                            class="text-limited badge badge-light-danger inv-status">{!! $message !!}</span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>

                                    <div style="cursor: pointer;" wire:click="editJsonUrl({{ $list->id }})"
                                        data-bs-toggle="modal" data-bs-target="#editJsonUrl">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24">
                                            <path
                                                d="M0 0 C3.375 -0.125 3.375 -0.125 7 0 C9 2 9 2 9.25 5 C9 8 9 8 7 10 C3.375 10.125 3.375 10.125 0 10 C0 9.34 0 8.68 0 8 C1.98 7.67 3.96 7.34 6 7 C6 5.68 6 4.36 6 3 C3.03 2.505 3.03 2.505 0 2 C0 1.34 0 0.68 0 0 Z "
                                                fill="#000000" transform="translate(14,7)" />
                                            <path
                                                d="M0 0 C1.670625 0.061875 1.670625 0.061875 3.375 0.125 C3.375 0.785 3.375 1.445 3.375 2.125 C1.395 2.455 -0.585 2.785 -2.625 3.125 C-2.625 4.445 -2.625 5.765 -2.625 7.125 C0.345 7.62 0.345 7.62 3.375 8.125 C3.375 8.785 3.375 9.445 3.375 10.125 C-0 10.25 -0 10.25 -3.625 10.125 C-5.625 8.125 -5.625 8.125 -5.875 5.125 C-5.4955869 0.57204274 -4.51633162 0.15573557 0 0 Z "
                                                fill="#000000" transform="translate(6.625,6.875)" />
                                            <path
                                                d="M0 0 C3.3 0 6.6 0 10 0 C10 0.66 10 1.32 10 2 C6.7 2 3.4 2 0 2 C0 1.34 0 0.68 0 0 Z "
                                                fill="#000000" transform="translate(7,11)" />
                                        </svg>
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
                                    <div class="form-check form-switch form-check-inline form-switch-primary">
                                        @if ($list->free_tour_status == '0')
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                style="cursor: pointer;" id="socialformprofile-custom-switch-success"
                                                {{ $list->free_tour_status == '1' ? 'checked' : '' }}
                                                wire:click="editFreeTour({{ $list->id }})" data-bs-toggle="modal"
                                                data-bs-target="#editFreeTour">
                                        @else
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                style="cursor: pointer;" id="socialformprofile-custom-switch-success"
                                                {{ $list->free_tour_status == '1' ? 'checked' : '' }}
                                                wire:click="updateDeactiveFreeTour({{ $list->id }})">
                                        @endif

                                    </div>
                                </td>

                                <td>
                                    <a class="me-3" data-bs-toggle="inputFormModal"
                                        href="{{ route('view.details', ['id' => $list->id]) }}"><img
                                            src="{{ asset('src/assets/img/icons/eye.svg') }}" alt="img">
                                    </a>
                                </td>
                                <td>
                                    <a class="me-2" wire:click="editTourPlace({{ $list->id }})"
                                        data-bs-toggle="modal" style="cursor: pointer;">
                                        <img src="{{ asset('src/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>
                                    <a wire:click="getDeleteTourPlace({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteTourPlace" style="cursor: pointer;">
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


@push('js')
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('modalOpened', () => {
                $('#editTourPlace').modal('show');

                ClassicEditor
                    .create(document.querySelector('#edit_description'))
                    .then(editor => {
                        let livewireComponent = window.Livewire.find(
                            document.querySelector('[wire\\:id]').getAttribute('wire:id')
                        );

                        // Load initial data from Livewire property
                        editor.setData(livewireComponent.get('edit_description') || '');

                        editor.model.document.on('change:data', () => {
                            livewireComponent.set('edit_description', editor.getData());
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#know_before_you_go'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('know_before_you_go', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('modalOpened', () => {
                $('#editTourPlace').modal('show');

                ClassicEditor
                    .create(document.querySelector('#edit_know_before_you_go'))
                    .then(editor => {
                        let livewireComponent = window.Livewire.find(
                            document.querySelector('[wire\\:id]').getAttribute('wire:id')
                        );

                        // Load initial data from Livewire property
                        editor.setData(livewireComponent.get('edit_know_before_you_go') || '');

                        editor.model.document.on('change:data', () => {
                            livewireComponent.set('edit_know_before_you_go', editor.getData());
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
    </script>
@endpush
