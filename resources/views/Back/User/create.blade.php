@extends('Back.layout.adminlayout')

@section('content')
<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header ">
            <div class="card-title">Create User</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->

        {!! Form::open(['route' => isset($user)?['user.update',$user->id]:'user.store', 'method' => isset($user)?'PUT':'POST', 'enctype' => 'multipart/form-data']) !!}
        @csrf
        <!--begin::Body-->
        <div class="card-body">
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
                @if(!$user)
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
                @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                @endif
            </div>


            <div class="input-group mb-3">

            @if($user && $user->userimage && $user->userimage->image)
            {!! Form::hidden('existing_image', $user->userimage->image ?? '', ['id' => 'existing_image']) !!}
                {{-- Error Message --}}
                @error('existing_image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                @endif
                {!! Form::file('image', ['class' => 'form-control', 'id' => 'Image']) !!}
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
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            {!! Form::button('Cancel', ['class' => 'btn btn-danger', 'id' => 'cancelButton']) !!}
        </div>
        <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Quick Example-->
</div>
@endsection