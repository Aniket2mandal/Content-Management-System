@extends('backend.layout.adminlayout')

@section('content')
<div class="card mt-4">
    <div class="card-header card-primary">
        <h3 class="card-title mt-4"> create field </h3>

        <div class="card-tools mt-4">
            <a href="{{ route('seo.fieldcreate') }}" class="btn btn-success">
                create field <i class="fas fa-plus"></i>
            </a>
        </div>


    </div>


    <div class="col-md mt-4">
        <!--begin::Quick Example-->
        <!--end::Header-->

        {!! Form::open(['route' => 'seo.infostore', 'method' => 'POST', 'id' => 'createFieldForm']) !!}
        @csrf
        <!--begin::Body-->
        <div class="card-body" id="fieldsContainer" style="padding: 15px;">
            <!-- Dynamically added fields will appear here -->
            <div class="container mt-4">
                @foreach($fields as $field)
                <div class="row align-items-center mb-3">
                    <div class="col-md-3 fw-bold">
                        {{ $field->label_name }}:
                    </div>
                    <div class="col-md-7">
                        @if($field->field_type == 'text')
                        {!! Form::text('fields['.$field->field_name.'][value]', $field->value ?? '', ['class' => 'form-control']) !!}
                        @elseif($field->field_type == 'textarea')
                        {!! Form::textarea('fields['.$field->field_name.'][value]', $field->value ?? '', ['id'=>'Description','class' => 'form-control']) !!}
                        @elseif($field->field_type == 'number')
                        {!! Form::number('fields['.$field->field_name.'][value]', $field->value ?? '', ['class' => 'form-control']) !!}
                        @endif
                    </div>
                    <div class="col-md-2">
                        <button id="delete" type="button" data-id="{{ $field->id }}" class="delete-btn btn btn-danger btn-sm"><i class="fas fa-trash"></i> <b>Delete</b></button>
                    </div>
                </div>
                @endforeach
            </div>


            <div class="card-footer">
                <!-- <button type="button" class="btn btn-success" id="addNewField">Add a New Field</button> -->
                <button type="submit" class="btn btn-primary" id="submitFields">Save/Update Fields</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!--end::Quick Example-->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $('.delete-btn').click(function() {
            var fieldId = $(this).data('id');
            console.log(fieldId);
            swal.fire({
                title: "Are You Sure?",
                text: "Do you want to delete the item ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("yess it is");
                    $.ajax({
                        method: 'GET',
                        url: '/seo/delete/' + fieldId,
                        success: function(response) {

                            // SweetAlert2 success popup
                            Swal.fire({
                                title: 'Success!',
                                text: 'The field deleted sucessfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                                // Remove the post element from the DOM (you can select the post by its ID or class)
                                $('#seo-' + fieldId).remove(); // Assuming each post has an id like "post-1", "post-2", etc.
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle any errors
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while deleting the post.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }

            });
        });
    });
</script>

@endsection