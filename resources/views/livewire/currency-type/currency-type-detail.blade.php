<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">Currency Type</li>
                <li>
                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#addCurrencyType">Add Currency Type</button>
                </li>
            </ol>
        </nav>
    </div>

    @include('livewire.modals.currencytype.add-currency-type')
    @include('livewire.modals.currencytype.edit-currency-type')
    @include('livewire.modals.currencytype.delete-currency-type')


    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Symbol</th>
                            <th>Status</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($currencytype as $list)
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->code }}</td>
                                <td>{{ $list->symbol }}</td>
                                <td>
                                    <div class="form-check form-switch form-check-inline form-switch-primary">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            style="cursor: pointer;" id="socialformprofile-custom-switch-success"
                                            {{ $list->status == '1' ? 'checked' : '' }}
                                            wire:click="updateStatus($event.target.checked,'{{ $list->id }}')">
                                    </div>
                                </td>
                                <td>
                                    <a class="" wire:click="editCurrencyType({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#editCurrencyType" style="cursor: pointer;">
                                        <img src="{{ asset('src/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>
                                    {{-- <a wire:click="getDelete({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteCurrencyType" style="cursor: pointer;">
                                        <img src="{{ asset('src/assets/img/icons/delete.svg') }}" alt="img">
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



