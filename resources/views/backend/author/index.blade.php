@extends('backend.layout.adminlayout')

@section('content')


<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title mt-4">Author List</h3>
        @can('create', \App\Models\Author::class)
        <div class="card-tools mt-4">
            <a href="{{ route('author.create') }}" class="btn btn-success">
                Add New Author <i class="fas fa-plus"></i>
            </a>
        </div>
        @endcan
    </div>
    @can('viewany', \App\Models\Author::class)
    <div class="card-body">
        <table class="table table-bordered table-striped mt-4">
            <thead class="table table-dark">
                <tr class="table">
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($author as $authors)
                <tr class="align-middle" id="post-{{ $authors->id }}">
                    <td>{{ $authors->Name }}</td>
                    <td>{{ $authors->Description }}</td>
                    <td>
                        <!-- @if($authors->Status == 1)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Deactive</span>
                        @endif -->
                        @can('changeStatus',App\Models\Author::class)
                        <div class="form-group ">
                            <!-- Toggle switch (default checked for Active) -->
                            <input type="hidden" name="Status" class="Status" value="0">
                            <input type="checkbox" name="Status" class="Status" data-id="{{$authors->id}}" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" value="1" {{ old('Status',$authors->Status) ? 'checked' : '' }}>
                            <!-- <small class="form-text text-muted">Switch to set the status to active or inactive</small> -->
                        </div>
                        @endcan
                    </td>
                    <td>
                        @if ($authors && $authors->image)
                        <img src="{{ asset('images/author/' . $authors->image) }}" alt="Author Image" width="80" height="80">
                        @else
                        <img src="{{ asset('adminlte/img/avatar.png') }}" class="img-circle" alt="User Image" width="80" height="80">
                        @endif
                    </td>
                    <td>
                        @can('edit',App\Models\Author::class)
                        <a href="{{route('author.edit',$authors->id)}}" class="btn btn-primary btn-sm me-3">
                            <i class="fas fa-pencil-alt"></i> <b>Edit</b>
                        </a>
                        @endcan
                        @can('delete',App\Models\Author::class)
                        <button id="delete" data-id="{{ $authors->id }}" class="delete-btn btn btn-danger btn-sm"><i class="fas fa-trash"></i> <b>Delete</b></button>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="card-footer clearfix">
            {{ $author->links('pagination::bootstrap-4') }}
        </div>
    </div>
    @endcan
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.Status').change(function() {
            var authorId = $(this).data('id');
            console.log(authorId);
            var Status = $(this).prop('checked') ? '1' : '0';
            console.log(Status);
            $.ajax({
                method: 'POST',
                url: '/authorstatus/' + authorId,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'Status': Status
                },
                success: function(response) {

                    // SweetAlert2 success popup
                    Swal.fire({
                        title: 'Success!',
                        text: 'The author shas been updated.',
                        icon: 'success',
                        confirmButtonText: 'OK'
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
                        url: '/authordelete/' + postId,

                        success: function(response) {

                            // SweetAlert2 success popup
                            Swal.fire({
                                title: 'Success!',
                                text: 'The author deleted sucessfully.',
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
                                text: 'An error occurred while deleting the author.',
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