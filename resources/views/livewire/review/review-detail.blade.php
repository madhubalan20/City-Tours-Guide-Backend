<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">

                <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                <li>
                    <button class="btn btn-primary additem _effect--ripple waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#addReview">Add Review</button>
                </li>
            </ol>
        </nav>
    </div>
    @include('livewire.modals.review.add-review')
    @include('livewire.modals.review.edit-review')
    @include('livewire.modals.review.delete-review')

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Rating Value</th>
                            <th>Review Content</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($reviewlist as $list)
                            @php
                                $content = wordwrap($list->review_content, 40, '<br>');
                            @endphp
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->rating_value }}</td>
                               
                                <td class="text-limited">
                                    {!! $content !!}
                                </td>
                               
                                <td>
                                    <a class="" wire:click="editReview({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#editReview" style="cursor: pointer;">
                                        <img src="{{ asset('src/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>
                                    <a wire:click="getDelete({{ $list->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteReview" style="cursor: pointer;">
                                        <img src="{{ asset('src/assets/img/icons/delete.svg') }}" alt="img">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

