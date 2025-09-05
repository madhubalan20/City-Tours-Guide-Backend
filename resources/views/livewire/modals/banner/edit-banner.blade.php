<div wire:ignore.self class="modal fade inputForm-modal" id="editBanner" tabindex="-1" role="document"
    aria-labelledby="inputFormModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">Edit <b>Banner</b></h5>
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
                            <input type="text" class="form-control form-control-sm" wire:model="edit_title" placeholder="Title">
                            @error('edit_title')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            <label for="text">Position</label>
                            <select class="form-select form-select-sm" wire:model.live='edit_position'>
                                <option selected>Select Position</option>
                                <option value="1">Top</option>
                                <option value="2">Bottom</option>
                            </select>
                            @error('edit_position')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    @if ($edit_file_type == 1)
                        <div class="col-md-6 mb-3">
                            <label for="text">File Type</label>
                            <select wire:model.live="edit_file_type" class="form-select form-select-sm">
                                <option value="">Select File Type</option>
                                <option value="1">Image</option>
                                <option value="2">Video</option>
                            </select>
                            @error('edit_file_type')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="">
                                <label>Image <span class="text-danger">(560 x 800)</span></label>
                                <input type="file" class="form-control form-control-sm" wire:model="edit_image">
                                @error('edit_image')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @elseif ($edit_file_type == 2)
                        <div class="col-md-6 mb-3">
                            <label for="text">File Type</label>
                            <select wire:model.live="edit_file_type" class="form-select form-select-sm">
                                <option value="">Select File Type</option>
                                <option value="1">Image</option>
                                <option value="2">Video</option>
                            </select>
                            @error('edit_file_type')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="text">Video Url</label>
                            <input type="text" name="Vedio Url" wire:model="edit_video_url"
                                class="form-control form-control-sm" placeholder="Video Url" autocomplete="off">
                            @error('edit_video_url')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                    @else
                        <div class="col-sm-12 mb-3">
                            <label for="text">File Type</label>
                            <select wire:model.live="edit_file_type" class="form-select form-select-sm">
                                <option value="">Select File Type</option>
                                <option value="1">Image</option>
                                <option value="2">Video</option>
                            </select>
                            @error('edit_file_type')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="row">
                    @if ($edit_broadcast == 1)
                        <div class="col-md-6 mb-3">
                            <label for="text">Type</label>
                            <select wire:model.live="edit_broadcast" class="form-select form-select-sm">
                                <option value="">Select Type</option>
                                <option value="1">Browse</option>
                                <option value="2">City</option>
                                <option value="3">Tour</option>
                            </select>
                            @error('edit_broadcast')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="text">Url</label>
                            <input type="text" name="url" wire:model="edit_url" class="form-control form-control-sm" placeholder="Url"
                                autocomplete="off">
                            @error('edit_url')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    @elseif ($edit_broadcast == 2)
                        <div class="col-md-6 mb-3">
                            <label for="text">Type</label>
                            <select wire:model.live="edit_broadcast" class="form-select form-select-sm">
                                <option value="">Select Type</option>
                                <option value="1">Browse</option>
                                <option value="2">City</option>
                                <option value="3">Tour</option>
                            </select>
                            @error('edit_broadcast')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="text">City</label>
                            <select class="form-select form-select-sm" wire:model.live="edit_city">
                                <option value="">Select City</option>
                                @foreach ($citylist as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('edit_city')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @elseif ($edit_broadcast == 3)
                        <div class="col-md-6 mb-3">
                            <label for="text">Type</label>
                            <select wire:model.live="edit_broadcast" class="form-select form-select-sm">
                                <option value="">Select Type</option>
                                <option value="1">Browse</option>
                                <option value="2">City</option>
                                <option value="3">Tour</option>
                            </select>
                            @error('edit_broadcast')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="text">Tour</label>
                            <select class="form-select form-select-sm" wire:model.live="edit_tour">
                                <option value="">Select Tour</option>
                                @foreach ($tourlist as $tour)
                                    <option value="{{ $tour->id }}">{{ $tour->title }}</option>
                                @endforeach
                            </select>
                            @error('edit_tour')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        <div class="col-sm-12 mb-3">
                            <label for="text">Type</label>
                            <select wire:model.live="edit_broadcast" class="form-select form-select-sm">
                                <option value="">Select Type</option>
                                <option value="1">Browse</option>
                                <option value="2">City</option>
                                <option value="3">Tour</option>
                            </select>
                            @error('edit_broadcast')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <div class="">
                            <label>Arrangement</label>
                            <input type="number" class="form-control form-control-sm" wire:model="edit_arrangement"
                                placeholder="Arrangement">
                            @error('edit_arrangement')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="">Description</label>
                        <textarea type="text" name="description" wire:model="edit_description" class="form-control form-control-sm" placeholder="Description"
                            autocomplete="on"></textarea>
                        @error('edit_description')
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
                    wire:click="updateBanner" wire:loading.remove wire:target="updateBanner">
                    Submit
                </button>

                <!-- Loading Button (Visible during loading) -->
                <button class="btn btn-primary mt-2 mb-2" type="button" wire:loading wire:target="updateBanner" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
        </div>
    </div>
</div>
