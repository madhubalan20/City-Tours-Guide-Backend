<div wire:ignore.self class="modal fade inputForm-modal" id="inputFormModal" tabindex="-1" role="document"
    aria-labelledby="inputFormModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">Add <b>Country</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('country.list') }}">
                    <svg
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    </a>
                </button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div class="col-sm-12">
                        <div class="">
                            <label>Country</label>
                            <input type="text" class="form-control form-control-sm" wire:model="country_name"
                                placeholder="Country">
                            @error('country_name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light-danger" data-bs-dismiss="modal" id="add_model_close">
                    <a href="{{ route('country.list') }}">Cancel</a>
                </button>
                <button class="btn btn-primary" wire:click="addcountry()">Submit</button>
            </div>
        </div>
    </div>
</div>

