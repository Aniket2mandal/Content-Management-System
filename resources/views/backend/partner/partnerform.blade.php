<div class="mb-3">
    {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
    {!! Form::text('name', old('name', $partner->name ?? null), ['class' => 'form-control', 'id' => 'name']) !!}
    {{-- Error Message --}}
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('url', 'Url', ['class' => 'form-label']) !!}
    {!! Form::url('url', old('url', $partner->url ?? null), ['class' => 'form-control', 'id' => 'url', 'rows' => 3]) !!}
    {{-- Error Message --}}
    @error('url')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('image', 'Image', ['class' => 'form-label']) !!}
    {!! Form::file('image', ['class' => 'form-control']) !!}
    {{-- Display Current Image if Available --}}
    @if(!empty($partner['image']))
        <div class="mt-2">
            <img src="{{ asset('storage/' . $partner->image) }}" alt="Current Image" class="img-thumbnail" width="150">
        </div>
    @endif
    {{-- Error Message --}}
    @error('image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('Status', 'Status', ['class' => 'form-label']) !!}
    {!! Form::hidden('Status', 0) !!}
    {!! Form::checkbox('Status', 1, old('Status', $partner->published ?? 0), [
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
