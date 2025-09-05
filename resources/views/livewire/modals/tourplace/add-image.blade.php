<div wire:ignore.self class="modal fade inputForm-modal" id="addImage" tabindex="-1" role="document"
    aria-labelledby="inputFormModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">Add <b>Image</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                    <a href="" onclick="goBack()">
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
                    <div class="col-sm-12">
                        <div class="">
                            <label>Image <span class="text-danger">(500 x 500)</span></label>
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
                    <a href="" onclick="goBack()">
                        Cancel
                    </a>
                </button>
                <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect" id="submitBtn"
                    onclick="handleSubmit()" wire:click="addImage()">
                    Submit
                </button>

                <button class="btn btn-primary" type="button" id="otherBtn" style="display: none;" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function goBack() {
        window.history.back();
    }

    function handleSubmit() {
        // Hide submit button
        document.getElementById('submitBtn').style.display = 'none';

        // Show other button
        document.getElementById('otherBtn').style.display = 'inline-block';
    }
</script>
