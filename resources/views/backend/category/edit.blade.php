@extends('backend.layout.adminlayout')

@section('content')

<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary">
        <!--begin::Header-->
        <div class="card-header">
            <h3 class="card-title">Update Category</h3>
        </div>
        <!--end::Header-->
        
        <!--begin::Form-->
        <form id="categoryForm" action="{{ route('category.update',$category->id)}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- Title Field (Required) -->
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="Title" value='{{ $category->Title }}' >
                    {{-- Error Message --}}
                    @error('Title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug Field (Required) -->
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="Slug" value='{{ $category->Slug }}'>
                    {{-- Error Message --}}
                    @error('Slug')
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
                        rows="5">{{$category->Description}}</textarea>
              
                    {{-- Error Message --}}
                    @error('Description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status Field -->
                <div class="form-group ">
                <label for="status">Status:</label><br>
                <!-- Toggle switch (default checked for Active) -->
                <input type="hidden" name="Status" value="0">
                <input type="checkbox" name="Status" id="Status" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" value="1" {{ old('Status',$category->Status) ? 'checked' : '' }}>
                <small class="form-text text-muted">Switch to set the status to active or inactive</small>
            </div>

            
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('category.index') }}" class="btn btn-danger" id="cancelButton">Cancel</a>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Quick Example-->
</div>
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

