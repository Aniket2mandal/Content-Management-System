@extends('backend.layout.adminlayout')

@section('content')
<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header ">
            <div class="card-title">Create Partner</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->

        {!! Form::open(['route' => 'slider.store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
        @csrf
        <!--begin::Body-->
        <div class="card-body">
            @include('backend.slider.sliderform')
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('slider.index') }}" class="btn btn-danger" id="cancelButton">Cancel</a>
        </div>
        <!--end::Footer-->
        {!! Form::close() !!}
        <!--end::Form-->
    </div>
    <!--end::Quick Example-->
</div>
@endsection