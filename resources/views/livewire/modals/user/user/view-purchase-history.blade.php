<div wire:ignore.self class="modal fade inputForm-modal" id="viewPurchaseDetails" tabindex="-1" role="document"
    aria-labelledby="inputFormModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">View <b>Details</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <div class="modal-body" >
                <div class="col-lg-12 col-md-12 col-sm-12 layout-top-spacing">

                    <div class="usr-tasks ">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>Purchase Id</b></td>
                                            <td>{{ $view_purchase->order_string ?? null }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Purchase Type</b></td>
                                            <td>{{ $view_purchase->purchase_type ?? null }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Tour</b></td>
                                            <td>{{ $view_purchase->tour_name ?? null }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>City</b></td>
                                            <td>{{ $view_purchase->city_name ?? null }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>State</b></td>
                                            <td>{{ $view_purchase->state_name ?? null }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Country</b></td>
                                            <td>{{ $view_purchase->country_name ?? null }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Coupon Amount</b></td>
                                            <td>₹ {{ $view_purchase->coupon_amount ?? '0' }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Offer Percentage</b></td>
                                            <td>{{ $view_purchase->offer_percentage ?? '0' }} %</td>
                                        </tr>

                                        <tr>
                                            <td><b>Purchase Date</b></td>
                                            <td>
                                                {{ $view_purchase && $view_purchase->purchase_date ? \Carbon\Carbon::parse($view_purchase->purchase_date)->format('d/m/Y') : 'N/A' }}
                                            </td>                                            
                                        </tr>

                                        <tr>
                                            <td><b>Expiry Date</b></td>
                                            <td>
                                                {{ $view_purchase && $view_purchase->expiry_date ? \Carbon\Carbon::parse($view_purchase->expiry_date)->format('d/m/Y') : 'N/A' }}
                                            </td>
                                        </tr>

                                        

                                        <tr>
                                            <td><b>Price</b></td>
                                            <td>₹ {{ $view_purchase->price ?? null }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Sub Total</b></td>
                                            <td>₹ {{ $view_purchase->sub_total ?? null }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Grand Total</b></td>
                                            <td>₹ {{ $view_purchase->overall_total ?? null }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .layout-top-spacing {
            margin-top: 0px;
        }
    </style>

<script>
    // Add event listener to reload the page when modal is closed
    document.getElementById('viewPurchaseDetails').addEventListener('hidden.bs.modal', function () {
        location.reload();
    });
</script>
</div>
