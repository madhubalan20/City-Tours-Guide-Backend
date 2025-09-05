<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">Purchase Details</li>
                <li>
                    <a href="{{ route('settings.report') }}">
                        <button class="btn btn-primary additem _effect--ripple waves-effect waves-light">Back</button>
                    </a>
                </li>
            </ol>
        </nav>
    </div>


    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Tour Place</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Coupon Amount</th>
                            <th>Offer Percentage</th>
                            <th>Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($purchaseTour as $list)
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $list->tour_name }}</td>
                                <td>{{ $list->city_name }}</td>
                                <td>{{ $list->state_name }}</td>
                                <td>{{ $list->country_name }}</td>
                                <td>₹ {{ $order->coupon_amount ?? '0' }}</td>
                                <td>{{ $list->offer_percentage ?? '0' }}%</td>
                                <td>₹ {{ $list->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
