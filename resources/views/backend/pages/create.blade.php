



{!! Form::open(['route' =>'page.store', 'method' => 'POST','id'=>'eventcreateForm'])!!}
@csrf
<!--begin::Body-->
<div class="card-body">
<div class="mb-3">
        {!! Form::label('Title', 'Title', ['class' => 'form-label','id'=>'titlelabel']) !!}
        {!! Form::text('title', old('title'), ['class' => 'form-control', 'id' => 'title']) !!}
        {{-- Error Message --}}
        @error('title')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        {!! Form::label('Slug', 'Slug', ['class' => 'form-label','id'=>'sluglabel']) !!}
        {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'id' => 'slug']) !!}
        {{-- Error Message --}}
        @error('slug')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
    {!! Form::label('Summary', 'Summary', ['class' => 'form-label','id'=>'summarylabel']) !!}
    {!! Form::text('summary', old('summary'), ['class' => 'form-control', 'id' => 'summary']) !!}
            {{-- Error Message --}}
        @error('summary')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('Status','Status:',['class'=>'form-label'])  !!}
        {!! Form:: hidden('Status',0) !!}

        {!! Form:: checkbox('Status',1, false,[
                'id' => 'Status',
                'data-toggle' => 'toggle',
                'data-on' => 'Active',
                'data-off' => 'Inactive',
                'data-onstyle' => 'success',
                'data-offstyle' => 'danger',
                'data-width' => '90',  // Adjust as necessary
                'data-height' => '35'
    ]) !!}
    </div>

    <div class="mb-3">
        {!! Form::label('Description', 'Description', ['class' => 'form-label']) !!}
        {!! Form::textarea('Description',old('Description'), [
            'id'=>'Description',
            'class' => 'form-control',
            'rows' => 5
        ]) !!}
        {{-- Error Message --}}
        @error('Description')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<!--end::Body-->

<!--begin::Footer-->
<div class="card-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <!-- <a href="{{ route('page.index') }}" class="btn btn-danger" id="cancelButton">Cancel</a> -->
</div>
<!--end::Footer-->
{!! Form::close() !!}