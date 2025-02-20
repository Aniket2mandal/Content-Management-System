@extends('backend.layout.adminlayout')

@section('content')
<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header ">
            <div class="card-title">Edit User</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->

        {!! Form::open(['route' => ['partner.update', $partner->id], 'method' => 'PUT','enctype'=>'multipart/form-data']) !!}
        @csrf
        <!--begin::Body-->
        <div class="card-body">
            @include('backend.partner.partnerform')
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('partner.index') }}" class="btn btn-danger" id="cancelButton">Cancel</a>
        </div>
        <!--end::Footer-->
        {!! Form::close() !!}
        <!--end::Form-->
    </div>
    <!--end::Quick Example-->
</div>
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

</script>
@endsection