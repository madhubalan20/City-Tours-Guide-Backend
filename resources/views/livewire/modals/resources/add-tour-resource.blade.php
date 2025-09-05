<div wire:ignore.self class="modal fade inputForm-modal" id="addTourResource" tabindex="-1" role="document"
    aria-labelledby="inputFormModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">Add <b>Tour Resource</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('resource.tour.detail') }}">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text">Tour</label>
                            <select class="form-select form-select-sm mb-3" wire:model='tour_name'>
                                <option selected>Select Tour</option>
                                @foreach ($selecttour as $list)
                                    <option value="{{ $list->id }}">{{ $list->title }}</option>
                                @endforeach
                            </select>
                            @error('tour_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="">
                            <label>Title</label>
                            <input type="text" class="form-control form-control-sm" wire:model="title" placeholder="Title"
                                required>
                            @error('title')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="">
                            <label>Icon <span class="text-danger">(34 x 34)</span></label>
                            <input type="file" class="form-control form-control-sm" wire:model="image">
                            @error('image')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="">
                            <label>Url</label>
                            <input type="text" class="form-control form-control-sm" wire:model="url" placeholder="Url"
                                required>
                            @error('url')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-light-danger mt-2 mb-2 btn-no-effect">
                    <a class="" href="{{ route('resource.tour.detail') }}">Cancel</a>
                </button>

                <!-- Submit Button (Visible when not loading) -->
                <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect"
                    wire:click="addTourResource" wire:loading.remove wire:target="addTourResource">
                    Submit
                </button>

                <!-- Loading Button (Visible during loading) -->
                <button class="btn btn-primary mt-2 mb-2" type="button" wire:loading wire:target="addTourResource" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
        </div>
    </div>
</div>

{{-- <style>
    .modal-content .modal-footer button.btn {
        font-weight: 600;
        padding: 8px 15px;
        letter-spacing: 1px;
    }
</style> --}}
