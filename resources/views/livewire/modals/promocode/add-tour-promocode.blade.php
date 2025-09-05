<div>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


    <div wire:ignore.self class="modal fade inputForm-modal" id="addTourPromocode" tabindex="-1" role="document"
        aria-labelledby="inputFormModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Add <b>Promocode</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                        <a href="{{ route('promocode.tour.promocode') }}">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </a>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="">
                                <label>Coupon Code</label>
                                <input type="text" class="form-control form-control-sm" wire:model="coupon_code"
                                    placeholder="Coupon Code" required>
                                @error('coupon_code')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="">
                                <label>Minimum Ordering Amount</label>
                                <input type="number" class="form-control form-control-sm"
                                    wire:model="minimum_order_amount" placeholder="Minimum Order Amount" required>
                                @error('minimum_order_amount')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="">
                                <label>Percentage</label>
                                <input type="number" class="form-control form-control-sm" wire:model="percentage"
                                    wire:keyup="updateFlatValue" placeholder="Percentage" required>
                                @error('percentage')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="">
                                <label>Maximum Discount Amount</label>
                                <input type="number" class="form-control form-control-sm"
                                    wire:model="maximum_discount_amount" placeholder="Maximum Discount Amount"
                                    wire:keyup="updateFlatValue" required>
                                @error('maximum_discount_amount')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="">
                                <label>Flat Amount</label>
                                <input type="number" class="form-control form-control-sm" wire:model="flat_amount"
                                    placeholder="Flat Amount" wire:keyup="updatePercentage" required>
                                @error('flat_amount')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="">
                                <label>Validate Date</label>
                                <input type="date" class="form-control form-control-sm" wire:model="validate_date"
                                    placeholder="Validate Date" required>
                                @error('validate_date')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">Select Tour</label><br>
                                <select class="form-select form-select-sm" wire:model='tour_name'>
                                    <option value="">Select Tour</option>
                                    @foreach ($selecttour as $list)
                                        <option value="{{ $list->id }}">{{ $list->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('tour_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">Select User</label><br>
                                <select class="form-select form-select-sm" wire:model='user_name'>
                                    <option value="">Select User</option>
                                    @foreach ($selectuser as $list)
                                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('user_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="">
                                <label for="">Description</label>
                                <textarea type="text" name="description" wire:model="description" class="form-control form-control-sm"
                                    rows="" placeholder="Description" autocomplete="on"></textarea>
                                @error('description')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-light-danger mt-2 mb-2 btn-no-effect">
                            <a class="" href="{{ route('promocode.tour.promocode') }}">Cancel</a>
                        </button>

                        <!-- Submit Button (Visible when not loading) -->
                        <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect"
                            wire:click="addCoupon" wire:loading.remove wire:target="addCoupon">
                            Submit
                        </button>

                        <!-- Loading Button (Visible during loading) -->
                        <button class="btn btn-primary mt-2 mb-2" type="button" wire:loading
                            wire:target="addCoupon" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
        .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 100%;
        }

        .bootstrap-select>.dropdown-toggle.bs-placeholder,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:hover,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:focus,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:active {
            color: #999;
            background-color: white;
            border: 1px solid #bfc9d4;
        }
    </style>
