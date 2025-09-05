<div wire:ignore.self class="modal fade inputForm-modal" id="inputFormModal" tabindex="-1" role="document"
    aria-labelledby="inputFormModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">Add <b>State</b></h5>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text">Country</label>
                            <select class="form-select  mb-3" wire:model='country_name'>
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
                    <div class="col-md-6 mb-3">
                        <div class="">
                            <label>State</label>
                            <input type="text" class="form-control" wire:model="state_name" placeholder="State"
                                required>
                            @error('state_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <label>Image</label>
                            <input type="file" class="form-control" wire:model="image">
                            @error('image')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-light-danger mt-2 mb-2 btn-no-effect">
                    <a class="" href="{{ route('state.list') }}">Cancel</a>
                </button>
                <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect" wire:click="addstate()">
                    Submit
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
