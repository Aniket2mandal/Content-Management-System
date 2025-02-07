@extends('Back.layout.adminlayout')

@section('content')

<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Role</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        {!! Form::open([ 'route' => isset($role) ? ['role.update', $role->id] : 'role.store', 
            'method' => isset($role) ? 'PUT' : 'POST']) !!}
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <!-- Title Field (Required) -->
                <div class="mb-3">
                    {!! Form::label('Name', 'Name', ['class' => 'form-label']) !!}
                    {!! Form::text('Name', old('Name', $role->name ?? null), ['class' => 'form-control', 'id' => 'Name']) !!}
                    {{-- Error Message --}}
                    @error('Name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug Field (Required) -->
                <div class="mb-3">
                    {!! Form::label('Slug', 'Slug', ['class' => 'form-label']) !!}
                    {!! Form::text('Slug',old('Slug', $role->slug ?? null), ['class' => 'form-control', 'id' => 'Slug']) !!}
                    {{-- Error Message --}}
                    @error('Slug')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Permissions Field -->
                <div class="mb-3">
                    {!! Form::label('Permission', 'Select Permissions', ['class' => 'form-label']) !!}
                    {!! Form::select('Permission[]', $permissions->pluck('name', 'id')->toArray(),   old('Permission', isset($role) ? $role->permissions->pluck('id')->toArray() : []), ['class' => 'form-control select2', 'id' => 'Permission', 'multiple' => 'multiple']) !!}
                    {{-- Error Message --}}
                    @error('Permission')
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
        <!--end::Form-->
    </div>
    <!--end::Quick Example-->
</div>

@endsection
