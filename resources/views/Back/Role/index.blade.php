@extends('Back.layout.adminlayout')

@section('content')


<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title mt-4">RoleList</h3>
        
        <div class="card-tools mt-4">
            <a href="{{ route('role.create') }}" class="btn btn-success">
                Add New Role<i class="fas fa-plus"></i>
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
                    <th>Permission Guranted</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=1;
                @endphp
                @foreach($roles as $role)
                    <tr class="align-middle">
                        <td>{{$i++}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->slug}}</td>
                        <td> 
                        @foreach($role->permissions as $permission)
                        <span class="badge bg-success">
                                {{$permission->name}}
                        </span>
                        @endforeach
                       
                        </td>
                        <td class="">
                            <a href="{{route('role.edit',$role->id)}}" class="btn btn-primary btn-sm me-2">
                                <i class="fas fa-pencil-alt"></i> <b>Edit</b>
                            </a>
                            <a href="{{route('role.delete',$role->id)}}" class="btn btn-danger btn-s ml-2">
                                <i class="fas fa-trash"></i> <b>Delete</b>
                            </a>
                        </td>
                    </tr>
        @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="card-footer clearfix">
            {{ $roles->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@endsection