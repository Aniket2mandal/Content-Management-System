@extends('Back.layout.adminlayout')

@section('content')

<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary  mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Create Category</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form id="categoryForm" action="{{ route('category.store') }}" method="POST">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <!-- Title Field (Required) -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input
                        type="text"
                        class="form-control"
                        id="Title"
                        name="Title"
                        required
                    />
                    {{-- Error Message --}}
                    @error('Title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug Field (Required) -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input
                        type="text"
                        class="form-control"
                        id="Slug"
                        name="Slug"
                        required
                    />
                    {{-- Error Message --}}
                    @error('Slug')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description Field with TinyMCE Editor -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        class="form-control"
                        id="Description"
                        name="Description"
                        rows="5"
                        required
                    ></textarea>
                    {{-- Error Message --}}
                    @error('Description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 ">
                <div class="form-group ">
                <label for="status">Status:</label><br>
                <!-- Toggle switch (default checked for Active) -->
                <input type="hidden" name="Status" value="0">
                <input type="checkbox" name="Status" id="Status" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" value="1" {{ old('Status') ? 'checked' : '' }}>
                <small class="form-text text-muted">Switch to set the status to active or inactive</small>
            </div>
</div>
            <!-- <input type="hidden" name="Status" id="toggleValue" value="0">
        <button type="button" id="toggleBtn" class="btn btn-primary" aria-pressed="false">
            Active
        </button> -->
                </div>              
    
            </div>
            <!--end::Body-->

            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" id="cancelButton"class="btn btn-danger">Cancel</button>
            </div>
            <div class="card-footer">
               
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Quick Example-->
</div>

<!-- Alert for Category Created Successfully -->
<!-- <div class="alert alert-success alert-dismissible fade" role="alert" id="successAlert" style="display:none;">
    <strong>Category Created Successfully!</strong>
</div> -->
@endsection

@section('scripts')
<!-- Include TinyMCE -->


<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Initialize TinyMCE editor
    tinymce.init({
        selector: '#description',
        plugins: 'link image code',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code',
    });


</script>
@endsection
