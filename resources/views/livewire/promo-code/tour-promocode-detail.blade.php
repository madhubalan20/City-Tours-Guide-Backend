<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">All Tour Promocode</li>
                <li>
                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#addTourPromocode">Add Promocode</button>
                </li>
            </ol>
        </nav>
    </div>

    @include('livewire.modals.promocode.add-tour-promocode')
    @include('livewire.modals.promocode.edit-tour-promocode')
    @include('livewire.modals.promocode.delete-user-promocode')

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Tour Name</th>
                            <th>User Name</th>
                            <th>Coupon Code</th>
                            <th>Minimum Order Amount</th>
                            <th>Percentage</th>
                            <th>Maximum Discount Amount</th>
                            <th>Flat Amount</th>
                            <th>Validate Date</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($promocodelist as $list)
                            @php
                                $tour = App\Models\TourPlace::where('id', $list->tour_id)->first();
                                $user = App\Models\User::where('id', $list->user_id)->first();
                                $description = wordwrap($list->description, 40, '<br>');
                            @endphp

                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $tour->title ?? '' }}</td>
                                <td>{{ $user->name ?? '' }}</td>
                                <td>{{ $list->coupon_code }}</td>
                                <td>{{ $list->minimum_order_amount }}</td>
                                <td>{{ $list->percentage }}</td>
                                <td>{{ $list->maximum_discount_amount }}</td>
                                <td>{{ $list->flat_amount }}</td>

                                @if (Carbon\Carbon::parse($list->validate_day)->isPast())
                                    <td class="text-danger">{{ $list->validate_day }} <br/>Coupon expired</td>
                                @else
                                    <td>{{ $list->validate_day }}</td>
                                @endif

                                <td class="text-limited">
                                    {!! $description !!}
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
                                    <a class="" wire:click="editTourPromocode({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#editTourPromocode" style="cursor: pointer;">
                                        <img src="{{ asset('src/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>
                                    <a wire:click="getDeletePromocode({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deletePromocode" style="cursor: pointer;">
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
