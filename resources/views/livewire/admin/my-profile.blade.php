<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">
                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
            </ol>
        </nav>
    </div>
    <div class="tab-content" id="animateLineContent-4">
        <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel"
            aria-labelledby="animated-underline-home-tab">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <div class="section general-info">
                        <div class="info">
                            <h6 class="">General Information</h6>
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="fullName">Name</label>
                                                            <input type="text" class="form-control mb-3"
                                                                wire:model='name' placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" class="form-control mb-3"
                                                                wire:model='phone_no' placeholder="Phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="text" class="form-control mb-3"
                                                               wire:model='email'
                                                                placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="image">Profile Image</label>
                                                            <input type="file" class="form-control mb-3"
                                                                wire:model="profile_image">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="newpassword">New Password</label>
                                                            <input type="password" class="form-control mb-3"
                                                                wire:model='new_password' placeholder="New Password">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="confirmpassword">Confirm Password</label>
                                                            <input type="password" class="form-control mb-3"
                                                                wire:model='confirm_password'
                                                                placeholder="Confirm Password">
                                                        </div>
                                                        @error('confirm_password')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mt-1">
                                                        <div class=" text-end">
                                                            <button class="btn btn-primary"
                                                                wire:click='upadateprofiles()'>Upadate</button>

                                                            <a href="{{ route('dashboard') }}"
                                                                class="btn btn-light-danger _effect--ripple waves-effect waves-light">Cancel
                                                            </a>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
