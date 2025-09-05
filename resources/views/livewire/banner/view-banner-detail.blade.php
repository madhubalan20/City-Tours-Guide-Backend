<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">Banner Details</li>
                <li>
                    <a href="{{ route('banner.topbottom.list') }}">
                        <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                            data-bs-toggle="modal" data-bs-target="#inputFormModal">Back</button>
                    </a>
                </li>
            </ol>
        </nav>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <div class="container">
                    <div class="pt-3 ps-2 pe-2 pb-4">
                        <div class="row">
                            <div class="form-group col-sm-6 mb-3">
                                <label>Position</label>
                                @if ($banner->position == 1)
                                    <input type="text" name="name" value="Top" class="form-control" style="color: black" readonly>
                                @else
                                    <input type="text" name="name" value="Bottom" class="form-control" style="color: black" readonly>
                                @endif

                            </div>

                            <div class="form-group col-sm-6 mb-3">
                                <label>Title</label>
                                <input type="text" name="name" value="{{ $banner->title }}" class="form-control" style="color: black" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 mb-3">
                                <label>Type</label>
                                @if ($banner->type == 1)
                                    <input type="text" name="name" value="Browse" class="form-control" style="color: black" readonly>
                                @elseif ($banner->type == 2)
                                    <input type="text" name="name" value="City" class="form-control" style="color: black" readonly>
                                @else
                                    <input type="text" name="name" value="Tour" class="form-control" style="color: black" readonly>
                                @endif
                            </div>

                            @if ($banner->type == 1)
                                <div class="form-group col-sm-6 mb-3">
                                    <label>Url</label>
                                    <input type="text" name="name" value="{{ $banner->url ?? '' }}"
                                        class="form-control" style="color: black" readonly>
                                </div>
                            @elseif ($banner->type == 2)
                                <div class="form-group col-sm-6 mb-3">
                                    <label>City</label>
                                    <input type="text" name="name" value="{{ $city_name->name ?? '' }}"
                                        class="form-control" style="color: black" readonly>
                                </div>
                            @else
                                <div class="form-group col-sm-6 mb-3">
                                    <label>Tour</label>
                                    <input type="text" name="name" value="{{ $tour_name->title ?? '' }}"
                                        class="form-control" style="color: black" readonly>
                                </div>
                            @endif
                        </div>

                        <div class="row">

                            <div class="form-group col-sm-6 mb-3">
                                <label>File Type</label>
                                @if ($banner->file_type == 1)
                                    <input type="text" name="name" value="Image" class="form-control" style="color: black" readonly>
                                @else
                                    <input type="text" name="name" value="Video" class="form-control" style="color: black" readonly>
                                @endif
                            </div>

                            <div class="form-group col-sm-6 mb-3">
                                <label>Vedio Url</label>
                                <input type="text" name="name" value="{{ $banner->vedio_url ?? '' }}"
                                    class="form-control" style="color: black" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 mb-3">
                                <label>Description</label>
                                <textarea type="text" name="name" class="form-control" style="color: black" readonly>
                                {{ $banner->description }}
                            </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
