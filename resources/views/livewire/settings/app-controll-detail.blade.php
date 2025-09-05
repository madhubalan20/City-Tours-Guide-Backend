<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">
                <li class="breadcrumb-item active" aria-current="page">App Control</li>
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
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-12 mt-md-0 mt-4">
                                            <div class="form">
                                                <div class="row mt-4">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">WhatsApp Number</label>
                                                            <input type="number" class="form-control mb-3"
                                                                wire:model='whats_app' placeholder="WhatsApp">
                                                        </div>
                                                        @error('whats_app')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Customer Support Number</label>
                                                            <input type="number" class="form-control mb-3"
                                                                wire:model='contact_no' placeholder="Contact Number">
                                                        </div>
                                                        @error('contact_no')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Tech Support Number</label>
                                                            <input type="number" class="form-control mb-3"
                                                                wire:model='tech_support_no'
                                                                placeholder="Contact Number">
                                                        </div>
                                                        @error('tech_support_no')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="Email">Contact Email</label>
                                                            <input type="text" class="form-control mb-3"
                                                                wire:model='email' placeholder="Email">
                                                        </div>
                                                        @error('email')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="Face Book">FaceBook link</label>
                                                            <input type="text" class="form-control mb-3"
                                                                wire:model='face_book' placeholder="Face Book">
                                                        </div>
                                                        @error('face_book')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Instagram Link</label>
                                                            <input type="text" class="form-control mb-3"
                                                                wire:model='instagram' placeholder="Instagram">
                                                        </div>
                                                        @error('instagram')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tech Support Url</label>
                                                            <input type="text" name="app_intime"
                                                                wire:model="tech_support_url" class="form-control mb-3"
                                                                placeholder="Tech Support Url">
                                                            @error('tech_support_url')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Office Timing</label>
                                                            <input type="text" name="app_outtime"
                                                                wire:model="office_timing" class="form-control mb-3"
                                                                placeholder="Office Timing">
                                                            @error('office_timing')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Tour Purchase Validate Days</label>
                                                            <input type="number" class="form-control mb-3"
                                                                wire:model='validate_day' placeholder="Validate Days">
                                                        </div>
                                                        @error('validate_day')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Mapbox Access Token</label>
                                                            <input type="text" name="app_outtime"
                                                                wire:model="mapbox_access_token"
                                                                class="form-control mb-3"
                                                                placeholder="Mapbox Access Token" autocomplete="off">
                                                            @error('mapbox_access_token')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">RAZORPAY KEY</label>
                                                            <input type="text" class="form-control mb-3"
                                                                wire:model='razorpay_key' placeholder="RAZORPAY KEY">
                                                        </div>
                                                        @error('razorpay_key')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">RAZORPAY SECRET</label>
                                                            <input type="text" class="form-control mb-3"
                                                                wire:model='razorpay_secret'
                                                                placeholder="RAZORPAY SECRET">
                                                        </div>
                                                        @error('razorpay_secret')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Android Version Code</label>
                                                            <input type="text" class="form-control mb-3"
                                                                placeholder="Android Version Code"
                                                                wire:model='android_version_code'>
                                                        </div>
                                                        @error('android_version_code')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Android Version Name</label>
                                                            <input type="text" class="form-control mb-3"
                                                                placeholder="Android Version Name"
                                                                wire:model='android_version_name'>
                                                        </div>
                                                        @error('android_version_name')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Splash Show Second</label>
                                                            <input type="number" class="form-control mb-3"
                                                                wire:model='splash_time_sec'>
                                                        </div>
                                                        @error('splash_time_sec')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 pt-0 mt-0">
                                                        <label for="email_footer_content">Email Footer
                                                            Content</label>
                                                        <div wire:ignore>
                                                            <textarea id="email_footer_content" class="form-control" rows="2" placeholder="Email Footer Content">
                                                                    {{ $email_footer_content }}
                                                                </textarea>
                                                        </div>
                                                        @error('email_footer_content')
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Splash Image <span class="text-danger">(Less than
                                                                    5mb)</span></label>
                                                            <input type="file" class="form-control mb-3"
                                                                wire:model.live='edit_splash_image'>
                                                        </div>
                                                        @error('edit_splash_image')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-2 mb-3 text-md-center">
                                                        <div class="form-group">
                                                            <img src="{{ $splash_image }}" alt=""
                                                                style="height: 100px; width:100px; border-radius: 5px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5);">
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">KEY</label>
                                                            <input type="text" class="form-control mb-3"
                                                                value={{ env('APP_KEY') }} readonly>
                                                        </div>

                                                    </div> --}}

                                                    {{-- <div class="col-md-2 mt-sm-0 pt-sm-0 mt-xl-4 pt-xl-2 mb-3">
                                                        <div class="form-group">
                                                            <label for="email"></label>

                                                            <a href="{{ route('key_generate') }}"><button
                                                                    class="btn btn-primary">Key Generate</button></a>
                                                        </div>
                                                    </div> --}}

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 mt-1">
                                                        <div class=" text-end">
                                                            {{-- <a href=""
                                                                class="btn btn-light-danger _effect--ripple waves-effect waves-light">Cancel</a> --}}
                                                            <button class="btn btn-primary"
                                                                wire:click='editappcontrol()'>Update</button>
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

@push('js')
    <script>
        ClassicEditor
            .create(document.querySelector('#email_footer_content'))
            .then(editor => {

                editor.model.document.on('change:data', () => {
                    @this.set('email_footer_content', editor.getData());
                })

                editor.setData(@this.get('email_footer_content') || '');
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
