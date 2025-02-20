@extends('backend.layout.adminlayout')

@section('content')


<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title mt-4">RoleList</h3>
        @can('create', \Spatie\Permission\Models\Role::class)
        <div class="card-tools mt-4">
            <a href="{{ route('role.create') }}" class="btn btn-success">
                Add New Role<i class="fas fa-plus"></i>
            </a>
        </div>
        @endcan

    </div>
    @can('viewany', \Spatie\Permission\Models\Role::class)
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
                <tr class="align-middle" id="post-{{ $role->id }}">
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
                        @can('edit', \Spatie\Permission\Models\Role::class)
                        <a href="{{route('role.edit',$role->id)}}" class="btn btn-primary btn-sm me-2">
                            <i class="fas fa-pencil-alt"></i> <b>Edit</b>
                        </a>
                        @endcan
                        @can('delete', \Spatie\Permission\Models\Role::class)
                        <button id="delete" data-id="{{ $role->id }}" class="delete-btn btn btn-danger btn-sm"><i class="fas fa-trash"></i> <b>Delete</b></button>
                        @endcan
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
    @endcan
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $('.delete-btn').click(function() {
            var postId = $(this).data('id');
            console.log(postId);
            swal.fire({
                title: "Are You Sure?",
                text: "Do you want to delete the item ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("yess it is");
                    $.ajax({
                        method: 'GET',
                        url: '/role/delete/' + postId,

                        success: function(response) {

                            // SweetAlert2 success popup
                            Swal.fire({
                                title: 'Success!',
                                text: 'The role deleted sucessfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                                // Remove the post element from the DOM (you can select the post by its ID or class)
                                $('#post-' + postId).remove(); // Assuming each post has an id like "post-1", "post-2", etc.
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle any errors
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while deleting the role.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }

            });
        });

    });
</script>
@endsection