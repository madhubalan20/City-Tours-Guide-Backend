<div wire:ignore.self class="modal fade inputForm-modal" id="editTourPlace" tabindex="-1" role="document"
    aria-labelledby="inputFormModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">Edit <b>Tour Place</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('tour_place.list') }}">
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
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">Country</label>
                            <select class="form-select form-select-sm mb-3" wire:model.live='edit_country_name'>
                                <option selected>Select Country</option>
                                @foreach ($selectcountry as $list)
                                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                                @endforeach
                            </select>
                            @error('edit_country_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">State</label>
                            <select class="form-select form-select-sm mb-3" wire:model.live='edit_state_name'>
                                    <option selected>Select State</option>
                                    @foreach ($editState as $list)
                                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                                    @endforeach
                            </select>
                            @error('edit_state_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-lg-4">
                        <div class="form-group">
                            <label for="text">City</label>
                            <select class="form-select form-select-sm mb-3" wire:model.live='edit_city_name'>
                                    <option selected>Select City</option>
                                    @foreach ($editcity as $list)
                                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                                    @endforeach
                            </select>
                            @error('edit_city_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                 
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Title</label>
                            <input type="text" class="form-control form-control-sm" wire:model="edit_title"
                                placeholder="Title">
                            @error('edit_title')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Duration Time</label>
                            <input type="text" class="form-control form-control-sm" wire:model="edit_duration_time"
                                placeholder="For Example 0-6 hrs">
                            @error('edit_duration_time')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Tour Audio Points</label>
                            <input type="number" class="form-control form-control-sm" wire:model="edit_audio_point"
                                placeholder="Audio Points">
                            @error('edit_audio_point')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Tour Stops</label>
                            <input type="number" class="form-control form-control-sm" wire:model="edit_tour_stop"
                                placeholder="Tour Stop">
                            @error('edit_tour_stop')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Demo Price</label>
                            <input type="number" class="form-control form-control-sm" wire:model.live="edit_demo_price"
                                wire:keyup="calculateeditdiscount" placeholder="Demo Price">
                            @error('edit_demo_price')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Offer Percentage</label>
                            <input type="number" class="form-control form-control-sm"
                                wire:model="edit_offer_percentage" wire:keyup="calculateeditdiscount"
                                placeholder="Offer Percentage">
                            @error('edit_offer_percentage')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Price</label>
                            <input type="number" class="form-control form-control-sm" wire:model="edit_price"
                                placeholder="Price">
                            @error('edit_price')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <label for="text">Tour Type</label>
                        <select wire:model.live="edit_tour_type" class="form-select form-select-sm">
                            <option value="disabled">Select Tour Type</option>
                            <option value="1">Single Tour</option>
                            <option value="2">Bundle Tour</option>
                        </select>
                        @error('tour_type')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Preview Image <span class="text-danger">(155 x 190)</span></label>
                            <input type="file" class="form-control form-control-sm"
                                wire:model="edit_preview_image">
                            @error('edit_preview_image')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3 mt-md-4">
                        <div class="form-group">
                            <img src="{{ $show_preview_image }}" alt=""
                                style="height: 50px; width:50px; border-radius: 5px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5);">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12 pt-0 mt-0 " >
                        <label for="">Description</label>
                        <div wire:ignore>
                        <textarea type="text" id="edit_description" wire:model.defer="edit_description" class="form-control"
                           rows="2" placeholder="Description" autocomplete="on"></textarea>
                        </div>
                        @error('edit_description')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12 pt-0 mt-0 " >
                        <label for="">Know Before You Go</label>
                        <div wire:ignore>
                        <textarea type="text" id="edit_know_before_you_go" wire:model.defer="edit_know_before_you_go" class="form-control"
                           rows="2" placeholder="Know Before You Go" autocomplete="on"></textarea>
                        </div>
                        @error('edit_know_before_you_go')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @foreach ($edit_location_inputs as $key => $value)
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <div class="">
                                <label>Latitude</label>
                                <input type="text" class="form-control form-control-sm"
                                    wire:model="edit_lat.{{ $key }}" placeholder="Latitude">
                                @error('edit_lat.' . $key)
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <div class="">
                                <label>Longitude</label>
                                <input type="text" class="form-control form-control-sm"
                                    wire:model="edit_long.{{ $key }}" placeholder="Longitude">
                                @error('edit_long.' . $key)
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($key != 0)
                            <div class="col-sm-2 mt-1 pt-sm-0 mb-3">
                                <button class="btn btn-danger btn-sm mt-md-4"
                                    wire:click.prevent="edit_removeLocation({{ $key }})"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                    </svg></button>
                            </div>
                        @else
                            <div class="col-sm-2 mt-1 pt-sm-0 mb-3">
                                <button class="btn btn-primary btn-sm mt-md-4"
                                    wire:click.prevent="editLocation({{ $k }})"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                    </svg></button>
                            </div>
                        @endif
                    </div>
                @endforeach

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-light-danger mt-2 mb-2 btn-no-effect">
                    <a class="" href="{{ route('tour_place.list') }}">Cancel</a>
                </button>

                <!-- Submit Button (Visible when not loading) -->
                <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect"
                    wire:click="updateTourPlace" wire:loading.remove wire:target="updateTourPlace">
                    Submit
                </button>

                <!-- Loading Button (Visible during loading) -->
                <button class="btn btn-primary mt-2 mb-2" type="button" wire:loading wire:target="updateTourPlace" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
        </div>
    </div>
</div>

