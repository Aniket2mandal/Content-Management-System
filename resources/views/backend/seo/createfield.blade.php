@extends('backend.layout.adminlayout')

@section('content')

<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Create Fields</div>
        </div>
        <!--end::Header-->

        {!! Form::open(['route' => 'seo.fieldstore', 'method' => 'POST', 'id' => 'createFieldForm']) !!}
        @csrf
        <!--begin::Body-->
        <div class="card-body" id="fieldsContainer" style="padding: 15px;">
            <!-- Dynamically added fields will appear here -->
        </div>

        <div class="card-footer">
            <button type="button" class="btn btn-success" id="addNewField">Add a New Field</button>
            <button type="submit" class="btn btn-primary" id="submitFields">Save Fields</button>
        </div>
        {!! Form::close() !!}
    </div>
    <!--end::Quick Example-->
</div>



<!-- Include JQuery for dynamic field handling -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Add new dynamic field form
        $('#addNewField').click(function() {
            var fieldHtml = `
                 <div class="row dynamic-field-form mb-3">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('fieldType', 'Field Type:', ['class' => 'form-label']) !!}
            {!! Form::select('field_type[]', ['text' => 'Text', 'textarea' => 'Text area', 'number' => 'Number'], null, ['class' => 'form-control fieldType']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('labelName', 'Label Name:', ['class' => 'form-label']) !!}
            {!! Form::text('label_name[]', null, ['class' => 'form-control labelName']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('fieldName', 'Field Name:', ['class' => 'form-label']) !!}
            {!! Form::text('field_name[]', null, ['class' => 'form-control fieldName']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-danger removeField" style="margin-top: 32px;">
            <i class="fas fa-trash"></i>
        </button>
    </div>
</div>

            `;
            $('#fieldsContainer').append(fieldHtml); // Add the form inside the card-body
            adjustCardHeight(); // Adjust the card's height after adding the form
        });

        // Remove a dynamic field form
        $('#fieldsContainer').on('click', '.removeField', function() {
            $(this).closest('.dynamic-field-form').remove();
            adjustCardHeight(); // Adjust the card's height after removing the form
        });

        // Adjust the card height to fit the added forms
        function adjustCardHeight() {
            var totalFields = $('#fieldsContainer .dynamic-field-form').length; // Total number of fields
            // console.log(totalFields);
            // var rows = Math.ceil(totalFields ); // 4 fields per row (col-md-3)
            // console.log(rows);
            var cardHeight = (totalFields * 120); // Adjust this value for spacing between fields
            $('.card-body').css('min-height', cardHeight + 'px'); // Dynamically set the minimum height
        }

        // Initial height adjustment when the page loads
        adjustCardHeight();


        // $('#submitFields').click(function(){
        //     var formData={
        //         field_type:[],
        //         label_name:[],
        //         field_name:[]
        //     }
        //     $('.dynamic-field-form').each(function(){
        //        var fieldType=$(this).find('.fieldType').val();
        //        var labelName=$(this).find('.labelName').val();
        //        var fieldName=$(this).find('.fieldName').val();

        //        formData.field_type.push(fieldType);
        //        formData.field_name.push(fieldName);
        //        formData.field_name.push(fieldName);
        //     });
        //     console.log(formData);

        // });
    });
</script>

@endsection