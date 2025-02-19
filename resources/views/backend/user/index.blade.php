@extends('backend.layout.adminlayout')

@section('content')
<!-- SweetAlert for session success message -->
<!-- Store Success Message in a Hidden Input Field -->
@if (session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif
<!-- <div class="success">
        @if (session('success'))
            <div class='container alert alert-success mt-4'>{{ session('success') }}</div>
        @endif
    </div> -->

<div class="card-header mt-4">
    <h3 class="card-title">User List</h3>
    <div class="card-tools">
        <!-- <div class="input-group input-group-sm" style="width: 150px;"> -->
        <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search" /> -->
        @can('create', \App\Models\User::class)
        <div class="input-group-append">
            <a href="{{route('user.create')}}" type="submit" class="btn btn-success">
                Add New User <i class="fas fa-plus"></i>
            </a>
            @endcan
        </div>
        <!-- </div> -->
    </div>
</div>
@can('viewany', \App\Models\User::class)
<div class="card-body">
    <table class="table table-bordered table-striped mt-4">
        <thead class="table table-dark">
            <tr class="table">
                <!-- <th style="width: 10px"></th> -->
                <th>S.N.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
            @endphp
            @foreach($user as $users)
            <tr class="align-middle" id="post-{{ $users->id }}">
                <td>{{$i++}}</td>
                <td>{{$users->name}}</td>
                <td>{{$users->email}}</td>
                <td>
                    <div class="form-group ">
                        <!-- Toggle switch (default checked for Active) -->
                        <input type="hidden" name="Status" class="Status" value="0">
                        <input type="checkbox" name="Status" class="Status" data-id="{{$users->id}}" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" value="1" {{ old('Status',$users->status) ? 'checked' : '' }}>
                        <!-- <small class="form-text text-muted">Switch to set the status to active or inactive</small> -->
                    </div>
                </td>
                <td>

                    @if ($users->userimage && $users->userimage->image)
                    <img src="{{ asset('images/user/' . $users->userimage->image) }}" alt="User Image" width="80" height="80">
                    @else
                    <img src="{{ asset('adminlte/img/avatar.png') }}" class="img-circle" alt="User Image" width="80" height="80">
                    @endif
                </td>
                <td>
                @can('edit', \App\Models\User::class)
                    <a href="{{route('user.edit',$users->id)}}" class="btn btn-primary btn-sm me-2 d-inline">
                        <i class="fas fa-pencil-alt"></i> <b>Edit</b>
                    </a>
                    @endcan
                    <!-- <a href="{{route('user.delete',$users->id)}}" class="btn btn-danger btn-sm d-inline">
                        <i class="fas fa-trash"></i> <b>Delete</b>
                    </a> -->
                    @can('delete', \App\Models\User::class)
                    <button id="delete" data-id="{{ $users->id }}" class="delete-btn btn btn-danger btn-sm"><i class="fas fa-trash"></i> <b>Delete</b></button>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Pagination -->
    <div class="card-footer clearfix">
        {{ $user->links('pagination::bootstrap-4') }}
    </div>
</div>
@endcan

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.Status').change(function() {
            var userId = $(this).data('id');
            console.log(userId);
            var Status = $(this).prop('checked') ? '1' : '0';
            console.log(Status);
            $.ajax({
                method: 'POST',
                url: '/userstatus/' + userId,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'Status': Status
                },
                success: function(response) {

                    // SweetAlert2 success popup
                    Swal.fire({
                        title: 'Success!',
                        text: 'The user status has been updated.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                                location.reload();
                                // Remove the post element from the DOM (you can select the post by its ID or class)
                                // $('#post-' + postId).remove(); // Assuming each post has an id like "post-1", "post-2", etc.
                            });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    Swal.fire({
                        title: 'Error!',
                        text: 'The is error updating status !',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

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
                        url: '/userdelete/' + postId,

                        success: function(response) {

                            // SweetAlert2 success popup
                            Swal.fire({
                                title: 'Success!',
                                text: 'The user deleted sucessfully.',
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
                                text: 'An error occurred while deleting the user.',
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