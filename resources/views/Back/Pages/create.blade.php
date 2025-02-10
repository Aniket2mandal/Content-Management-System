{!! Form::open(['method' => 'POST','id'=>'eventForm'])!!}
    @csrf
    <!--begin::Body-->
    <div class="card-body">
        <div class="mb-3">
            {!! Form::label('Name', 'Name', ['class' => 'form-label']) !!}
            {!! Form::text('Name', old('Name'), ['class' => 'form-control', 'id' => 'Name']) !!}
            {{-- Error Message --}}
            @error('Name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            {!! Form::label('Email', 'Email', ['class' => 'form-label']) !!}
            {!! Form::email('Email', old('Email'), ['class' => 'form-control', 'id' => 'Email']) !!}
            {{-- Error Message --}}
            @error('Email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

      
    </div>
    <!--end::Body-->

    <!--begin::Footer-->
    <div class="card-footer">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        {!! Form::button('Cancel', ['class' => 'btn btn-danger', 'id' => 'cancelButton']) !!}
    </div>
    <!--end::Footer-->
{!! Form::close() !!}
