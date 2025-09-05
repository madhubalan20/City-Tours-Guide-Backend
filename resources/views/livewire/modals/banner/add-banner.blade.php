<div wire:ignore.self class="modal fade inputForm-modal" id="inputFormModal" tabindex="-1" role="document"
    aria-labelledby="inputFormModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">Add <b>Banner</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('banner.topbottom.list') }}">
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
                    <div class="mb-3 col-md-6">
                        <div class="">
                            <label>Title</label>
                            <input type="text" class="form-control form-control-sm" wire:model="title"
                                placeholder="Title">
                            @error('title')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            <label for="text">Position</label>
                            <select class="form-select form-select-sm" wire:model='position'>
                                <option value="">Select Position</option>
                                <option value="1">Top</option>
                                <option value="2">Bottom</option>
                            </select>
                            @error('position')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                </div>

                {{-- <div class="row">
                    <div class="mb-3 col-md-6">
                        <div class="">
                            <label>Image</label>
                            <input type="file" class="form-control form-control-sm" wire:model="image">
                            @error('image')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    @if ($file_type == 1)
                        <div class="col-md-6 mb-3">
                            <label for="text">File Type</label>
                            <select wire:model.live="file_type" class="form-select form-select-sm">
                                <option value="">Select File Type</option>
                                <option value="1">Image</option>
                                <option value="2">Video</option>
                            </select>
                            @error('file_type')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="">
                                <label>Image <span class="text-danger">(560 x 800)</span></label>
                                <input type="file" class="form-control form-control-sm" wire:model="image">
                                @error('image')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @elseif ($file_type == 2)
                        <div class="col-md-6 mb-3">
                            <label for="text">File Type</label>
                            <select wire:model.live="file_type" class="form-select form-select-sm">
                                <option value="">Select File Type</option>
                                <option value="1">Image</option>
                                <option value="2">Video</option>
                            </select>
                            @error('file_type')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="text">Video Url</label>
                            <input type="text" name="Vedio Url" wire:model="video_url"
                                class="form-control form-control-sm" placeholder="Video Url" autocomplete="off">
                            @error('video_url')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                    @else
                        <div class="col-sm-12 mb-3">
                            <label for="text">File Type</label>
                            <select wire:model.live="file_type" class="form-select form-select-sm">
                                <option value="">Select File Type</option>
                                <option value="1">Image</option>
                                <option value="2">Video</option>
                            </select>
                            @error('file_type')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="row">
                    @if ($broadcast == 1)
                        <div class="col-md-6 mb-3">
                            <label for="text">Type</label>
                            <select wire:model.live="broadcast" class="form-select form-select-sm">
                                <option value="">Select Type</option>
                                <option value="1">Browse</option>
                                <option value="2">City</option>
                                <option value="3">Tour</option>
                            </select>
                            @error('broadcast')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="text">Url</label>
                            <input type="text" name="url" wire:model="url"
                                class="form-control form-control-sm" placeholder="Url" autocomplete="off">
                            @error('url')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    @elseif ($broadcast == 2)
                        <div class="col-md-6 mb-3">
                            <label for="text">Type</label>
                            <select wire:model.live="broadcast" class="form-select form-select-sm">
                                <option value="">Select Type</option>
                                <option value="1">Browse</option>
                                <option value="2">City</option>
                                <option value="3">Tour</option>
                            </select>
                            @error('broadcast')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="text">City</label>
                            <select class="form-select form-select-sm" wire:model.live="city">
                                <option value="">Select City</option>
                                @foreach ($citylist as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('city')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @elseif ($broadcast == 3)
                        <div class="col-md-6 mb-3">
                            <label for="text">Type</label>
                            <select wire:model.live="broadcast" class="form-select form-select-sm">
                                <option value="">Select Type</option>
                                <option value="1">Browse</option>
                                <option value="2">City</option>
                                <option value="3">Tour</option>
                            </select>
                            @error('broadcast')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="text">Tour</label>
                            <select class="form-select form-select-sm" wire:model.live="tour">
                                <option value="">Select Tour</option>
                                @foreach ($tourlist as $tour)
                                    <option value="{{ $tour->id }}">{{ $tour->title }}</option>
                                @endforeach
                            </select>
                            @error('tour')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        <div class="col-sm-12 mb-3">
                            <label for="text">Type</label>
                            <select wire:model.live="broadcast" class="form-select form-select-sm">
                                <option value="">Select Type</option>
                                <option value="1">Browse</option>
                                <option value="2">City</option>
                                <option value="3">Tour</option>
                            </select>
                            @error('broadcast')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <div class="">
                            <label>Arrangement</label>
                            <input type="number" class="form-control form-control-sm" wire:model="arrangement"
                                placeholder="Arrangement">
                            @error('arrangement')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="">Description</label>
                        <textarea type="text" name="description" wire:model="description" class="form-control form-control-sm"
                            placeholder="Description" autocomplete="on"></textarea>
                        @error('description')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-light-danger mt-2 mb-2 btn-no-effect">
                    <a class="" href="{{ route('banner.topbottom.list') }}">Cancel</a>
                </button>

                <!-- Submit Button (Visible when not loading) -->
                <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect"
                    wire:click="addBanner" wire:loading.remove wire:target="addBanner">
                    Submit
                </button>

                <!-- Loading Button (Visible during loading) -->
                <button class="btn btn-primary mt-2 mb-2" type="button" wire:loading wire:target="addBanner" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
        </div>
    </div>
</div>
