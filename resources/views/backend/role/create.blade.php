@extends('backend.layout.adminlayout')

@section('content')

<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Role Create</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        {!! Form::open([ 'route' => 'role.store', 'method' => 'POST']) !!}
            @csrf
            <!--begin::Body-->
            <div class="card-body">
            @include('backend.role.roleform') 
            </div>
            <!--end::Body-->

            <!--begin::Footer-->
            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('role.index') }}" class="btn btn-danger" id="cancelButton">Cancel</a>
            </div>
            <!--end::Footer-->
        {!! Form::close() !!}
        <!--end::Form-->
    </div>
    <!--end::Quick Example-->
</div>

@endsection
