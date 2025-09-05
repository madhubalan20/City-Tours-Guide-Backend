<div wire:ignore.self class="modal fade inputForm-modal" id="inputFormModal" tabindex="-1" role="document"
    aria-labelledby="inputFormModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">Add <b>Tour Place</b></h5>
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
                            <select class="form-select form-select-sm mb-3" wire:model.live='country_name'>
                                <option selected>Select Country</option>
                                @foreach ($selectcountry as $list)
                                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                                @endforeach
                            </select>
                            @error('country_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">State</label>
                            <select class="form-select form-select-sm mb-3" wire:model.live='state_name'>
                                @if ($country_name)
                                    <option selected>Select State</option>
                                    @foreach ($selectstate as $list)
                                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">Select first country</option>
                                @endif

                            </select>
                            @error('state_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">City</label>
                            <select class="form-select form-select-sm mb-3" wire:model.live='city_name'>
                                @if ($state_name)
                                    <option selected>Select State</option>
                                    @foreach ($selectcity as $list)
                                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">Select first state</option>
                                @endif
                            </select>
                            @error('city_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                   
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Title</label>
                            <input type="text" class="form-control form-control-sm" wire:model="title"
                                placeholder="Title">
                            @error('title')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Duration Time</label>
                            <input type="text" class="form-control form-control-sm" wire:model="duration_time"
                                placeholder="For Example 0-6 hrs">
                            @error('duration_time')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Tour Audio Points</label>
                            <input type="number" class="form-control form-control-sm" wire:model="audio_point"
                                placeholder="Audio Points">
                            @error('audio_point')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                 
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Tour Stops</label>
                            <input type="number" class="form-control form-control-sm" wire:model="tour_stop"
                                placeholder="Tour Stop">
                            @error('tour_stop')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Json Url</label>
                            <input type="text" class="form-control form-control-sm" wire:model="url"
                                placeholder="Url">
                            @error('url')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Demo Price</label>
                            <input type="number" class="form-control form-control-sm" wire:model.live="demo_price"
                                wire:keyup="calculatediscount" placeholder="Demo Price">
                            @error('demo_price')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Offer Percentage</label>
                            <input type="number" class="form-control form-control-sm" wire:model="offer_percentage"
                                wire:keyup="calculatediscount" placeholder="Offer Percentage">
                            @error('offer_percentage')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Price</label>
                            <input type="number" class="form-control form-control-sm" wire:model="price"
                                placeholder="Price">
                            @error('price')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <label for="text">Tour Type</label>
                        <select wire:model.live="tour_type" class="form-select form-select-sm">
                            <option value="disabled">Select Tour Type</option>
                            <option value="1">Single Tour</option>
                            <option value="2">Bundle Tour</option>
                        </select>
                        @error('tour_type')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Preview Image <span class="text-danger">(155 x 190)</span></label>
                            <input type="file" class="form-control form-control-sm" wire:model="preview_image">
                            @error('preview_image')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="">
                            <label>Images <span class="text-danger">(500 x 500)</span></label>
                            <input type="file" class="form-control form-control-sm" wire:model="images" multiple>
                            @error('images')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <div wire:ignore>
                            <textarea type="text" wire:model.defer="description" id="description" class="form-control form-control-sm"
                                rows="2" placeholder="Description" autocomplete="on"></textarea>
                        </div>
                        @error('description')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-12 mb-3">
                        <label>Know Before You Go</label>
                        <div wire:ignore>
                            <textarea type="text" wire:model.defer="know_before_you_go" id="know_before_you_go" class="form-control form-control-sm"
                                rows="2" placeholder="Know Before You Go" autocomplete="on"></textarea>
                        </div>
                        @error('know_before_you_go')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <div class="">
                            <label>Latitude</label>
                            <input type="text" class="form-control form-control-sm" wire:model="lat.0"
                                placeholder="Latitude">
                            @error('lat.0')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-5 mb-3">
                        <div class="">
                            <label>Longitude</label>
                            <input type="text" class="form-control form-control-sm" wire:model="long.0"
                                placeholder="Longitude">
                            @error('long.0')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-2 mt-1 pt-sm-0 mb-3">
                        <button class="btn btn-primary btn-sm mt-md-4"
                            wire:click.prevent="addLocation({{ $j }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                        </button>
                    </div>
                </div>

                @foreach ($location_inputs as $key => $value)
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <div class="">
                                <label>Latitude</label>
                                <input type="text" class="form-control form-control-sm"
                                    wire:model="lat.{{ $key + 1 }}" placeholder="Latitude">
                                @error('lat.' . $key + 1)
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <div class="">
                                <label>Longitude</label>
                                <input type="text" class="form-control form-control-sm"
                                    wire:model="long.{{ $key + 1 }}" placeholder="Longitude">
                                @error('long.' . $key + 1)
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($j > 0)
                            <div class="col-sm-2 mt-1 pt-sm-0 mb-3">
                                <button class="btn btn-danger btn-sm mt-md-4"
                                    wire:click.prevent="removeLocation({{ $key + 1 }})"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                    </svg></button>
                            </div>
                        @endif
                    </div>
                @endforeach

                <div class="row">
                    <div class="col-md-10 mb-3">
                        <div class="">
                            <label>Video Url</label>
                            <input type="text" class="form-control form-control-sm" wire:model="video_url.0"
                                placeholder="Video Url">
                            @error('video_url.0')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-2 mt-1 pt-sm-0 mb-3">
                        <button class="btn btn-primary btn-sm mt-md-4"
                            wire:click.prevent="addDiv({{ $i }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                        </button>
                    </div>
                </div>

                @foreach ($inputs as $key => $value)
                    <div class="row">
                        <div class="col-md-10 mb-3">
                            <div class="">
                                <label>Video Url</label>
                                <input type="text" class="form-control form-control-sm"
                                    wire:model="video_url.{{ $key + 1 }}" placeholder="Video Url">
                                @error('video_url.' . $key + 1)
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($i > 0)
                            <div class="col-sm-2 mt-1 pt-sm-0 mb-3">
                                <button class="btn btn-danger btn-sm mt-md-4"
                                    wire:click.prevent="remove({{ $key + 1 }})"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
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
                <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect" id="submitBtn"
                    onclick="handleSubmit()" wire:click="addTourPlace()">
                    Submit
                </button>

                <button class="btn btn-primary" type="button" id="otherBtn" style="display: none;" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
        </div>
    </div>

    <script>
        function handleSubmit() {
            document.getElementById('submitBtn').style.display = 'none';
            document.getElementById('otherBtn').style.display = 'inline-block';
        }
    </script>
</div>
