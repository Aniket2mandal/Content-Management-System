<div class="mb-3">
    {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
    {!! Form::text('name', old('name', $testimonial->name ?? null), ['class' => 'form-control', 'id' => 'name']) !!}
    {{-- Error Message --}}
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('message', 'Message', ['class' => 'form-label']) !!}
    {!! Form::textarea('message', old('message', $testimonial->message ?? null), ['class' => 'form-control', 'id' => 'Description', 'rows' => 3]) !!}
    {{-- Error Message --}}
    @error('message')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('image', 'Image', ['class' => 'form-label']) !!}
    {!! Form::file('image', ['class' => 'form-control','onchange'=>'previewImage(event)']) !!}
    {{-- Display Current Image if Available --}}
    @if(!empty($testimonial['image']))
        <div class="mt-2">
            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Current Image" class="img-thumbnail" width="150">
        </div>
    @endif
     <!-- Image Preview -->
     <div class="mt-3" id="imagePreviewContainer" style="position: relative; display: none;">
        <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid rounded" style="width: 100px; border: 1px solid #ddd; padding: 5px;">
         <!-- Cross Button to Remove Image (Initially Hidden) -->
         <button type="button" class="btn-close" aria-label="Close" onclick="removeImage()" style="position: absolute; top: 5px; right: 5px; display: none;"></button>
        </div>
    {{-- Error Message --}}
    @error('image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('Status', 'Status', ['class' => 'form-label']) !!}
    {!! Form::hidden('Status', 0) !!}
    {!! Form::checkbox('Status', 1, old('Status', $testimonial->published ?? 0), [
        'id' => 'Status', 
        'data-toggle' => 'toggle', 
        'data-on' => 'Publish', 
        'data-off' => 'Unpublish', 
        'data-onstyle' => 'success', 
        'data-offstyle' => 'danger'
    ]) !!}
    <small class="form-text text-muted">Switch to set the status to publish or unpublish</small>
    {{-- Error Message --}}
    @error('Status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
