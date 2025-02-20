@extends('backend.layout.adminlayout')

@section('content')


<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title mt-4">Category List</h3>
        @can('create', \App\Models\Category::class)
        <div class="card-tools mt-4">
            <a href="{{ route('category.create') }}" class="btn btn-success">
                Add New Category <i class="fas fa-plus"></i>
            </a>
        </div>
        @endcan
    </div>
    @can('viewany', \App\Models\Category::class)
    <div class="card-body">
        <table class="table table-bordered table-striped mt-4">
            <thead class="table table-dark">
                <tr class="table">
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Description</th>

                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach($category as $categories)
                <tr class="align-middle" id="post-{{ $categories->id }}">
                    <td>{{ $categories->Title }}</td>
                    <td>{{ $categories->Slug }}</td>
                    <td>{{ $categories->Description }}</td>


                    <td>
                        <!-- @if($categories->Status == 1)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Deactive</span>
                            @endif -->
                        @can('changeStatus',App\Models\Category::class)
                        <div class="form-group ">
                            <!-- Toggle switch (default checked for Active) -->
                            <input type="hidden" name="Status" class="Status" value="0">
                            <input type="checkbox" name="Status" class="Status" data-id="{{$categories->id}}" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" value="1" {{ old('Status',$categories->Status) ? 'checked' : '' }}>
                            <!-- <small class="form-text text-muted">Switch to set the status to active or inactive</small> -->
                        </div>
                        @endcan
                    </td>


                    <td class="">
                        @can('edit',App\Models\Category::class)
                        <a href="{{ route('category.edit', $categories->id) }}" class="btn btn-primary btn-sm me-2">
                            <i class="fas fa-pencil-alt"></i> <b>Edit</b>
                        </a>
                        @endcan
                        @can('delete',App\Models\Category::class)
                        <button id="delete" data-id="{{ $categories->id }}" class="delete-btn btn btn-danger btn-sm"><i class="fas fa-trash"></i> <b>Delete</b></button>
                        @endcan
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="card-footer clearfix">
            {{ $category->links('pagination::bootstrap-4') }}
        </div>
    </div>
    @endcan
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.Status').change(function() {
            var categoryId = $(this).data('id');
            console.log(categoryId);
            var Status = $(this).prop('checked') ? '1' : '0';
            console.log(Status);
            $.ajax({
                method: 'POST',
                url: '/categorystatus/' + categoryId,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'Status': Status
                },
                success: function(response) {

                    // SweetAlert2 success popup
                    Swal.fire({
                        title: 'Success!',
                        text: 'The Category status has been updated.',
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
                        url: '/category/delete/' + postId,

                        success: function(response) {

                            // SweetAlert2 success popup
                            Swal.fire({
                                title: 'Success!',
                                text: 'The category deleted sucessfully.',
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
                                text: 'An error occurred while deleting the category.',
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