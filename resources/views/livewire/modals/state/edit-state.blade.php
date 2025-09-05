<div wire:ignore.self class="modal fade inputForm-modal" id="editState" tabindex="-1" role="document"
    aria-labelledby="inputFormModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">Edit <b>State</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('state.list') }}">
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
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text">Country</label>
                            <select class="form-select form-select-sm mb-3" wire:model='editcountry_name'>
                                @foreach ($selectcountry as $list)
                                <option value="{{ $list->id }}">{{ $list->name }}</option>
                                @endforeach
                            </select>
                            @error('editcountry_name')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="">
                            <label>State</label>
                            <input type="text" class="form-control form-control-sm" wire:model="edit_state_name" placeholder="State">
                            @error('edit_state_name')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <label>Image</label>
                            <input type="file" class="form-control" wire:model="edit_image">
                            @error('edit_image')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-light-danger mt-2 mb-2 btn-no-effect">
                    <a class="" href="{{ route('state.list') }}">Cancel</a>
                </button>

                <!-- Submit Button (Visible when not loading) -->
                <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect"
                    wire:click="updateState" wire:loading.remove wire:target="updateState">
                    Submit
                </button>

                <!-- Loading Button (Visible during loading) -->
                <button class="btn btn-primary mt-2 mb-2" type="button" wire:loading wire:target="updateState" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
        </div>
    </div>
</div>