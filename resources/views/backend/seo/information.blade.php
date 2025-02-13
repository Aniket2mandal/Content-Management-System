@extends('backend.layout.adminlayout')

@section('content')

<div class="card-tools mt-4">
            <a href="{{ route('seo.fieldcreate') }}" class="btn btn-success">
                create field <i class="fas fa-plus"></i>
            </a>
        </div>

        <div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Create Fields</div>
        </div>
        <!--end::Header-->

        {!! Form::open(['route' => 'seo.infostore', 'method' => 'POST', 'id' => 'createFieldForm']) !!}
        @csrf
        <!--begin::Body-->
        <div class="card-body" id="fieldsContainer" style="padding: 15px;">
            <!-- Dynamically added fields will appear here -->
             
        </div>

        <div class="card-footer">
            <button type="button" class="btn btn-success" id="addNewField">Add a New Field</button>
            <button type="submit" class="btn btn-primary" id="submitFields">Save Fields</button>
        </div>
        {!! Form::close() !!}
    </div>
    <!--end::Quick Example-->
</div>
@endsection
