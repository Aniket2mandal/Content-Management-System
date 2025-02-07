@extends('Back.layout.adminlayout')

@section('content')


<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title mt-4">Permission List</h3>
        <div class="card-tools mt-4">
            <a href="{{ route('permission.create') }}" class="btn btn-success">
                Add New Permission<i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped mt-4">
            <thead class="table table-dark">
                <tr class="table">
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                @php
                    $i=1;
                @endphp
                @foreach($permission as $permissions)
                    <tr class="align-middle">
                        <td>{{$i++}}</td>
                        <td>{{$permissions->name}}</td>
                        <td>{{$permissions->slug}}</td>
        
                        <!-- <td class="">
                            <a href="" class="btn btn-primary btn-sm me-2">
                                <i class="fas fa-pencil-alt"></i> <b>Edit</b>
                            </a>
                            <a href="" class="btn btn-danger btn-s ml-2">
                                <i class="fas fa-trash"></i> <b>Delete</b>
                            </a>
                        </td> -->
                    </tr>
        @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="card-footer clearfix">
        {{ $permission->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@endsection