<div class="mb-3">
    {!! Form::label('Name', 'Name', ['class' => 'form-label']) !!}
    {!! Form::text('Name', old('Name', $user->name ?? null), ['class' => 'form-control', 'id' => 'Name']) !!}
    {{-- Error Message --}}
    @error('Name')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    {!! Form::label('Email', 'Email', ['class' => 'form-label']) !!}
    {!! Form::email('Email', old('Email', $user->email ?? null), ['class' => 'form-control', 'id' => 'Email']) !!}
    {{-- Error Message --}}
    @error('Email')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">

    {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}

    {{-- Error Message --}}
    @error('password')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'form-label']) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation']) !!}
    {{-- Error Message --}}
    @error('password')
    <div class="text-danger">{{ $message }}</div>
    @enderror

</div>


<div class="input-group mb-3">

    @if($user && $user->userimage && $user->userimage->image)
    {!! Form::hidden('existing_image', $user->userimage->image ?? '', ['id' => 'existing_image']) !!}
    {{-- Error Message --}}
    @error('existing_image')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    @endif

    {!! Form::label('image', 'Image:', ['class' => 'form-label']) !!}
    {!! Form::file('image', ['class' => 'form-control', 'id' => 'Image','onchange'=>'previewImage(event)']) !!}
    <div class="input-group mb-3 mt-2">
        @if(isset($user) && $user->userimage && $user->userimage->image)
        <img src="{{ asset('images/user/' . $user->userimage->image) }}" alt="No Image" style="max-height: 100px; max-width: 100px;">
        @endif
    </div>
    <!-- Image Preview -->
    <div class="mt-3" id="imagePreviewContainer" style="position: relative; display: none;">
        <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid rounded" style="width: 100px; border: 1px solid #ddd; padding: 5px;">
        <button type="button" class="btn-close" aria-label="Close" onclick="removeImage()" style="position: absolute; top: 5px; right: 5px; display: none;"></button>
        </div>
    {{-- Error Message --}}
    @error('image')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group ">
    {!! Form::label('Status', 'Status:', ['class' => 'form-label']) !!}

    <!-- Hidden input to set the default value as 0 if the checkbox is unchecked -->
    {!! Form::hidden('Status', 0) !!}

    <!-- Checkbox for the toggle switch -->
    {!! Form::checkbox('Status', 1, old('Status', isset($user) ? $user->status : 0), [
    'id' => 'Status',
    'data-toggle' => 'toggle',
    'data-on' => 'Active',
    'data-off' => 'Inactive',
    'data-onstyle' => 'success',
    'data-offstyle' => 'danger'
    ]) !!}
    <small class="form-text text-muted">Switch to set the status to active or inactive</small>

    <!-- Error message for validation -->
    @error('Status')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('Role', 'Select roles', ['class' => 'form-label']) !!}
    {!! Form::select('Role', $roles->pluck('name', 'id')->toArray(), old('Role', isset($user) ? $user->roles->pluck('id')->toArray() : []), ['class' => 'form-control select2', 'id' => 'Permission', 'multiple' => 'multiple']) !!}
    {{-- Error Message --}}
    @error('Role')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
