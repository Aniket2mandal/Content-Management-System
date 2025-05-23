@extends('backend.layout.adminlayout')

@section('content')

<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary mb-4">
        <!--begin::Header-->
        <div class="card-header card-primary">
            <div class="card-title">Update Post</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form id="categoryForm" action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <!-- Title Field (Required) -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input
                        type="text"
                        class="form-control"
                        id="title"
                        name="Title"
                        value='{{ $post->Title }}' />
                    {{-- Error Message --}}
                    @error('Title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug Field (Required) -->
                <div class="mb-3">
                    <label for="Description" class="form-label">Description</label>
                    <textarea

                        class="form-control"
                        id="Description"
                        name="Description"
                        rows="5">{{ $post->Description }}</textarea>
                    {{-- Error Message --}}
                    @error('Description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description Field with TinyMCE Editor -->
                <div class="mb-3">
                    <label for="summary" class="form-label">Summary</label>
                    <textarea
                        class="form-control"
                        id="Description"
                        name="Summary"
                        rows="5"
                        value=''>{{ $post->Summary }}</textarea>
                    {{-- Error Message --}}
                    @error('Summary')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- <div class="mb-3 ">
                    <label for="status" class="form-label">Status</label>
                   <button type="button" class="btn btn-success" id="Status">Active</button>
                </div> -->

                <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile02">Image</label>
                    <input type="file" class="form-control" id="inputGroupFile02" name="image" onchange="previewImage(event)" />
                    <label class="input-group-text" for="inputGroupFile02">Choose Image</label>

                    @if(isset($post) && $post->image)
                    <div class="input-group mb-3 mt-2">
                        <img src="{{ asset('images/post/' . $post->image) }}" style="max-height: 100px; max-width: 100px;">
                        <!-- <p>Current image</p> -->
                    </div>
                    @endif
                    {{-- Error Message --}}
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Image Preview -->
                <div class="mt-3" id="imagePreviewContainer" style="position: relative; display: none;">
                    <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid rounded" style="width: 100px; border: 1px solid #ddd; padding: 5px;">

                    <!-- Cross Button to Remove Image (Initially Hidden) -->
                    <button type="button" class="btn-close" aria-label="Close" onclick="removeImage()" style="position: absolute; top: 5px; right: 5px; display: none;"></button>
                </div>

                <!-- <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control select2" id="Status" name="Status" required>
                            <option value="1" {{ $post->Status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $post->Status == 0 ? 'selected' : '' }}>Deactive</option>
                        </select>
                    </div> -->

                <div class="form-group ">
                    <label for="status">Status:</label><br>
                    <!-- Toggle switch (default checked for Active) -->
                    <input type="hidden" name="Status" value="0">
                    <input type="checkbox" name="Status" id="Status" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" value="1" {{ old('Status',$post->Status) ? 'checked' : '' }}>
                    <small class="form-text text-muted">Switch to set the status to active or inactive</small>
                </div>


                <div class="mb-3">
                    <label for="status" class="form-label">Category</label>
                    <select class="form-control select2" id="Category" name="Category[]" multiple="multiple">
                        <!-- <option value="" selected>Select Category</option> -->
                        @foreach($category as $item)
                        <option value="{{ $item->id }}" {{ $post->categories->contains('id', $item->id) ? 'selected' : '' }}>{{ $item->Title }}</option>
                        @endforeach
                    </select>
                    {{-- Error Message --}}
                    @error('Category')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Author</label>
                    <select class="form-control select2" id="Author" name="Author[]" multiple="multiple">
                        <!-- <option value="" selected>Select Author</option> -->
                        @foreach($author as $item)
                        <option value="{{ $item->id }}" {{ $post->authors->contains('id', $item->id) ? 'selected' : '' }}>{{ $item->Name }}</option>
                        @endforeach
                    </select>
                    {{-- Error Message --}}
                    @error('Author')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- <div class="mb-3 col-md-6">
    <label for="catefory" class="form-label">Category</label>
    <select class="form-control select2" id="Category" name="Category" required>
    <option value="" selected>Select Category</option>
               
                         

    </select> -->
            </div>
    </div>
</div>
<!--end::Body-->

<!--begin::Footer-->
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('post.index') }}" class="btn btn-danger" id="cancelButton">Cancel</a>
</div>
<div class="card-footer">

</div>
<!--end::Footer-->
</form>
<!--end::Form-->
</div>
<!--end::Quick Example-->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            var previewContainer = document.getElementById('imagePreviewContainer');
            var closeButton = document.querySelector('#imagePreviewContainer .btn-close');

            // Set the image source
            output.src = reader.result;

            // Show the preview container
            previewContainer.style.display = 'block';

            // Show the close button
            closeButton.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function removeImage() {
        var previewContainer = document.getElementById('imagePreviewContainer');
        var closeButton = document.querySelector('#imagePreviewContainer .btn-close');
        var fileInput = document.getElementById('inputGroupFile02');
        var output = document.getElementById('imagePreview');

        // Hide the image preview and close button
        previewContainer.style.display = 'none';
        closeButton.style.display = 'none';

        // Clear the input value and reset the image preview
        fileInput.value = '';
        output.src = '#';
    }

</script>
@endsection