@extends('Back.layout.adminlayout')

@section('content')

<div class="col-md mt-4">
    <!--begin::Quick Example-->
    <div class="card card-primary  mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Create Permission</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form id="permissionForm" action="{{route('permission.store')}}" method="POST">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <!-- Title Field (Required) -->
                <div class="mb-3">
                    <label for="title" class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="Name"
                        name="Name"
                       
                    />
                    {{-- Error Message --}}
                    @error('Name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug Field (Required) -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input
                        type="text"
                        class="form-control"
                        id="Slug"
                        name="Slug"
                        required
                    />
                    {{-- Error Message --}}
                    @error('Slug')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
               
                </div>              
    
            </div>
            <!--end::Body-->

            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" id="cancelButton"class="btn btn-danger">Cancel</button>
            </div>
            <div class="card-footer">
               
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Quick Example-->
</div>

<!-- Alert for Category Created Successfully -->
<!-- <div class="alert alert-success alert-dismissible fade" role="alert" id="successAlert" style="display:none;">
    <strong>Category Created Successfully!</strong>
</div> -->
@endsection


