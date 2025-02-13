@extends('backend.layout.adminlayout')

@section('content')

<div class="card mt-4">
    <div class="card-header ">
        <h3 class="card-title mt-4">Pages List</h3>

        <div class="card-tools">
            <!-- <div class="input-group input-group-sm" style="width: 150px;"> -->
            <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search" /> -->

            @can('create', \App\Models\Page::class)
            <div class="input-group-append mt-4">
                <button id="create" data-toggle="modal" data-target="#createEventModal" class="create-btn btn btn-success"> Add New Page <i class="fas fa-plus"></i></button>
            </div>
            @endcan
            <!-- </div> -->
        </div>
    </div>

    @can('viewany', \App\Models\Page::class)
    <div class="card-body ">
        <table class="table table-bordered table-striped mt-4">
            <thead class="table table-dark">
                <tr class=" table">
                    <!-- <th style="width: 10px"></th> -->
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Summary</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach($pages as $page)
                <tr class="align-middle">
                    <td>{{$i++}}</td>
                    <td>{{$page->Page_title}}</td>
                    <td>{{$page->Page_slug}}</td>
                    <td>{{$page->Page_summary}}</td>
                    <td>{{$page->Page_description}}</td>
                    <td>

                        <div class="form-group ">
                            <!-- Toggle switch (default checked for Active) -->
                            <input type="hidden" name="Status" class="Status" value="0">
                            <input type="checkbox" name="Status" class="Status" data-id="{{$page->id}}" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" value="1" {{ old('Status',$page->Page_status) ? 'checked' : '' }}>
                            <!-- <small class="form-text text-muted">Switch to set the status to active or inactive</small> -->
                        </div>

                    </td>

                    <td class="">
                        @can('edit', \App\Models\Page::class)
                        <button  data-id="{{$page->id}}" class="edit-btn btn-primary btn-sm"> <i class="fas fa-pencil-alt"></i> <b>Edit</b></button>
                        @endcan
                        @can('delete', \App\Models\Page::class)
                        <button id="delete"  data-id="{{$page->id}}" class="delete-btn btn btn-danger btn-sm"><i class="fas fa-trash"></i> <b>Delete</b></button>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
  <!-- Pagination -->
  <div class="card-footer clearfix">
            {{ $pages->links('pagination::bootstrap-4') }}
        </div>
    </div>
    </div>
    @endcan
</div>
<!-- <button class="btn btn-successs" data-toggle="modal" data-target="#createEventModal">Create Event</button> -->

<!-- Modal -->
<div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Create Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('backend.pages.create') ;
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Edit Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('backend.pages.edit') ;
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.Status').change(function() {
            var postId = $(this).data('id');
            var Status = $(this).prop('checked') ? '1' : '0';
            console.log(postId + Status);
            $.ajax({
                method: 'POST',
                url: '/pagestatus/' + postId,
                data: {
                    '_token': '{{csrf_token()}}',
                    'Status': Status
                },
                success: function(response) {

                    // SweetAlert2 success popup
                    Swal.fire({
                        title: 'Success!',
                        text: 'The page status has been updated.',
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
                        url: '/pagedelete/' + postId,

                        success: function(response) {

                            // SweetAlert2 success popup
                            Swal.fire({
                                title: 'Success!',
                                text: 'The post deleted sucessfully.',
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
                                text: 'An error occurred while deleting the post.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }

            });
        });

        // Show the modal for editing an existing page
        $('.edit-btn').on('click', function() {
            var pageId = $(this).data('id'); // Assuming you're passing the page ID in the button's data-id attribute
            console.log(pageId);
            $.ajax({
                url: '/pageedit/' + pageId,
                // Endpoint to fetch the existing page data
                type: 'GET',

                success: function(response) {
                    console.log(response);

                    // Populate the form with the data from the response
                    $('#editEventModal #title').val(response.data.Page_title);
                    $('#editEventModal #slug').val(response.data.Page_slug);
                    // FOR STATUS
                    $('#editEventModal #Status').closest('.form-group').remove();
                    $('#editEventModal #summary').val(response.data.Page_summary);
                    tinymce.get('Description').setContent(response.data.Page_description); 
                    
                   // Set content in TinyMCE editor
                    $('#editEventModal').modal('show');
                    
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to load page data.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

        // Submit form when modal is saved
        $('#eventcreateForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();
            console.log(formData); // Debug statement

            $.ajax({
                url:'/pagestore',
                method:'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'The page created sucessfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();

                        $('#createEventModal').modal('hide'); //Hide the modal after success
                    });

                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while saving the page.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });


        // Submit form when modal is saved
        $('#eventeditForm').on('submit', function(e) {
            e.preventDefault();
            
            var pageId = $(this).data('id');
            var formData = $(this).serialize();
            console.log(formData); // Debug statement

            $.ajax({
                url:'/pageupdate/',
                method:'PUT',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'The page updated sucessfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();

                        $('#editEventModal').modal('hide'); //Hide the modal after success
                    });

                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while updating the page.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

    });
</script>

@endsection