@extends('backend.layout.adminlayout')

@section('content')

<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary  mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Create Author</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form id="authorForm" action="{{ route('author.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <!-- Title Field (Required) -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="Name"
                        name="Name"
                         />
                    {{-- Error Message --}}
                    @error('Name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Description Field with TinyMCE Editor -->
                <div class="mb-3">
                    <label for="Description" class="form-label">Description</label>
                    <textarea

                        class="form-control"
                        id="Description"
                        name="Description"
                        rows="5"></textarea>
              
                    {{-- Error Message --}}
                    @error('Description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status Field (Required) -->
                <!-- <div class="mb-3 ">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control select2" id="Status" name="Status" required>
                        <option value="" selected>Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                    </select>
                </div> -->

                <div class="form-group ">
                <label for="status">Status:</label><br>
                <!-- Toggle switch (default checked for Active) -->
                <input type="hidden" name="Status" value="0">
                <input type="checkbox" name="Status" id="Status" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" value="1" {{ old('Status') ? 'checked' : '' }}>
                <small class="form-text text-muted">Switch to set the status to active or inactive</small>
            </div>
                <!-- <input type="hidden" name="Status" id="toggleValue" value="0">
        <button type="button" id="toggleBtn" class="btn btn-primary" aria-pressed="false">
            Active
        </button> -->

                <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile02">Image</label>
                    <input type="file" class="form-control" id="inputGroupFile02" name="image" onchange="previewImage(event)" />
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
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
            </div>

  
    <!--end::Body-->

    <!--begin::Footer-->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('author.index') }}" class="btn btn-danger" id="cancelButton">Cancel</a>
    </div>

    <div class="card-footer">

    </div>
    <!--end::Footer-->
    </form>
    </div>
    <!--end::Form-->
</div>
<!--end::Quick Example-->
</div>

<!-- Alert for Category Created Successfully -->
<!-- <div class="alert alert-success alert-dismissible fade" role="alert" id="successAlert" style="display:none;">
    <strong>Category Created Successfully!</strong>
</div> -->



<!-- Include TinyMCE -->

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
        var output = document.getElementById('imagePreview');
        var outputContainer = document.getElementById('imagePreviewContainer');
        var closeButton = document.querySelector('#imagePreviewContainer .btn-close');
        output.src = '#';
        outputContainer.style.display = 'none';
        closeButton.style.display = 'none';
    }
</script>

<script>
    // Initialize TinyMCE editor
    tinymce.init({
        selector: '#description',
        plugins: 'link image code',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code',
    });
</script>

@endsection