<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">Purchase History</li>
                <li>
                    <button onclick="window.history.back()"
                        class="btn btn-primary additem _effect--ripple waves-effect waves-light">Back</button>
                </li>
            </ol>
        </nav>
    </div>

    @include('livewire.modals.user.user.view-purchase-history')

    <div class="row layout-top-spacing mt-4">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Purchase Id</th>
                            <th>Purchase Type</th>
                            <th>Tour</th>
                            <th>City</th>
                            <th>Price</th>
                            <th>Purchase Date</th>
                            <th>Expiry Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($purchase_lists as $list)
                            <tr class="text-center" wire:ignore>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $list->order_string }}</td>
                                <td>{{ $list->purchase_type }}</td>
                                <td>{{ $list->tour_name }}</td>
                                <td>{{ $list->city_name }}</td>
                                <td>₹ {{ $list->price }}</td>
                                <td>{{ \Carbon\Carbon::parse($list->purchase_date)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($list->expiry_date)->format('d/m/Y') }}</td>
                                <td>
                                    <a class="me-3" data-bs-toggle="modal" data-bs-target="#viewPurchaseDetails"
                                        wire:click="viewPurchaseDetail({{ $list->id }})"
                                        style="cursor: pointer"><img src="{{ asset('src/assets/img/icons/eye.svg') }}"
                                            alt="img">
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
