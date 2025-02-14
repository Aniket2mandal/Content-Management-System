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
        var fieldIndex = 0; // Start index for field names

$('#addNewField').click(function() {
    fieldIndex++; // Increment the index for unique field names

    var fieldHtml = `
    <div class="row dynamic-field-form mb-3" data-index="${fieldIndex}">
        <div class="col-md-3">
            <div class="form-group">
                <label for="fields[${fieldIndex}][field_type]" class="form-label">Field Type:</label>
                <select name="fields[${fieldIndex}][field_type]" class="form-control">
                    <option value="text">Text</option>
                    <option value="textarea">Text Area</option>
                    <option value="number">Number</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="fields[${fieldIndex}][label_name]" class="form-label">Label Name:</label>
                <input type="text" name="fields[${fieldIndex}][label_name]" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="fields[${fieldIndex}][field_name]" class="form-label">Field Name:</label>
                <input type="text" name="fields[${fieldIndex}][field_name]" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-danger removeField" style="margin-top: 32px;">
                <i class="fas fa-trash"></i> Remove
            </button>
        </div>
    </div>`;

    $('#fieldsContainer').append(fieldHtml);
    adjustCardHeight(); 
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
     
    });
</script>

@endsection