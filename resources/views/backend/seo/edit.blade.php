@extends('backend.layout.adminlayout')

@section('content')

<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Edit Fields</div>
        </div>
        <!--end::Header-->

        {!! Form::open(['route' => ['seo.fieldupdate', $slider['id']], 'method' => 'POST', 'id' => 'dynamic-form']) !!}

        <div id="fields-container" class="mb-3">
          
        </div>

        <button type="button" id="add-field" class="btn btn-success mt-3">Add New Field +</button>
        {!! Form::submit('Submit', ['class' => 'btn btn-primary mt-3', 'id' => 'submit-button', 'disabled' => true]) !!}
        <a href="{{ route('seo.index') }}" class="btn btn-danger mt-3">Cancel</a>

        {!! Form::close() !!}
    </div>

    <style>
        .field-group {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background: #f9f9f9;
            margin-bottom: 10px;
        }

        .field-group .form-control,
        .field-group select {
            flex: 1;
        }

        .remove-field {
            white-space: nowrap;
        }
    </style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let fieldIndex = 0;
    const addFieldButton = document.getElementById('add-field');
    const submitButton = document.getElementById('submit-button');
    const container = document.getElementById('fields-container');

    // Function to add a new field
    function addNewField() {
        const fieldHTML = `
            <div class="field-group" id="field-${fieldIndex}">
                <select name="fields[${fieldIndex}][type]" class="form-control field-type">
                    <option value="text">Text</option>
                    <option value="textarea">Textarea</option>
                    <option value="number">Number</option>
                </select>
                 {{-- Error Message --}}
                    @error('fields[${fieldIndex}][type]')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                <input type="text" name="fields[${fieldIndex}][label]" class="form-control field-label" 
                    placeholder="Enter Label" data-index="${fieldIndex}" >
                     {{-- Error Message --}}
                    @error('fields[${fieldIndex}][label]')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                <input type="text" name="fields[${fieldIndex}][name]" class="form-control field-name" 
                    placeholder="Field Name" pattern="^[a-z0-9_]+$" readonly >
                     {{-- Error Message --}}
                    @error('fields[${fieldIndex}][name]')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                <button type="button" class="btn btn-danger remove-field" data-id="${fieldIndex}">Remove</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', fieldHTML);
        fieldIndex++;
        checkSubmitButton();
    }

    // Handle click event on "Add New Field" button
    addFieldButton.addEventListener('click', function () {
        addNewField();
    });

    // Handle input event for label name (generate field name)
    container.addEventListener('input', function (event) {
        if (event.target.classList.contains('field-label')) {
            let index = event.target.getAttribute('data-index');
            let slug = event.target.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g, '_') // Replace non-alphanumeric characters with "_"
                .replace(/^_|_$/g, ''); // Remove leading or trailing "_"

            // Select input safely using a more robust approach
            let fieldNameInput = event.target.closest('.field-group').querySelector('.field-name');

            if (fieldNameInput) {
                fieldNameInput.value = slug;
            }
        }
    });

    // Handle input event to enforce number validation
    container.addEventListener('input', function (event) {
        if (event.target.classList.contains('field-value')) {
            let fieldGroup = event.target.closest('.field-group');
            let fieldType = fieldGroup.querySelector('.field-type').value;

            if (fieldType === 'number') {
                event.target.value = event.target.value.replace(/[^0-9]/g, ''); // Allow only numbers
            }
        }
    });

    // Handle click event for removing a field
    container.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-field')) {
            const fieldId = event.target.getAttribute('data-id');
            const fieldElement = document.getElementById(`field-${fieldId}`);
            if (fieldElement) {
                fieldElement.remove();
                checkSubmitButton();
            }
        }
    });

    // Enable/disable submit button based on fields count
    function checkSubmitButton() {
        submitButton.disabled = container.children.length === 0;
    }
});
</script>


@endsection