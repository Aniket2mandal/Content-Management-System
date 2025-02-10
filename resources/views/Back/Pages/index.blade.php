@extends('Back.layout.adminlayout')

@section('content')

<div class="card mt-4">
    <div class="card-header ">
        <h3 class="card-title mt-4">Pages List</h3>

        <div class="card-tools">
            <!-- <div class="input-group input-group-sm" style="width: 150px;"> -->
            <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search" /> -->
          
            <div class="input-group-append mt-4">
              
                <button id="create" data-toggle="modal" data-target="#createEventModal" class="create-btn btn btn-success"> Add New Page <i class="fas fa-plus"></i></button>
            </div>
   
            <!-- </div> -->
        </div>
    </div>
    

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
               
                <tr class="align-middle">
                    <td>{{$i++}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                       
                        <div class="form-group ">
                            <!-- Toggle switch (default checked for Active) -->
                            <input type="hidden" name="Status" class="Status" value="0">
                            <input type="checkbox" name="Status" class="Status" data-id="" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" value="1" {{ old('Status') ? 'checked' : '' }}>
                            <!-- <small class="form-text text-muted">Switch to set the status to active or inactive</small> -->
                        </div>
                        
                    </td>

                    <td class="">

                        
                        <a href="" class="btn btn-primary btn-sm me-2 ">
                            <i class="fas fa-pencil-alt"></i> <b>Edit</b>
                        </a>
                        <button id="delete" data-id="" class="delete-btn btn btn-danger btn-sm"><i class="fas fa-trash"></i> <b>Delete</b></button>

                  
                    </td>
                </tr>
             
            </tbody>
        </table>
        <!-- Pagination -->
     
    </div>
</div>
<!-- <button class="btn btn-successs" data-toggle="modal" data-target="#createEventModal">Create Event</button> -->

<!-- Modal -->
<div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Create Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            @include('Back.Pages.create') ;
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
            $.ajax({
                method: 'POST',
                url: '/poststatus/' + postId,
                data: {
                    '_token': '{{csrf_token()}}',
                    'Status': Status
                },
                success: function(response) {

                    // SweetAlert2 success popup
                    Swal.fire({
                        title: 'Success!',
                        text: 'The post status has been updated.',
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
                        url: '/postdelete/' + postId,

                        success: function(response) {

                            // SweetAlert2 success popup
                            Swal.fire({
                                title: 'Success!',
                                text: 'The post deleted sucessfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {

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


        $('#eventForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();
            console.log(formData); // Debug statement

            $.ajax({
                url: '',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log("Success response:", response); // Debug statement
                    alert('Event created successfully');
                    location.reload();
                },
                error: function(xhr) {
                    console.log("Error response:", xhr); // Debug statement
                    var errors = xhr.responseJSON ? xhr.responseJSON.errors : {'error': 'Internal Server Error'};
                    var errorHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value + '</li>';
                    });
                    errorHtml += '</ul></div>';
                    $('.modal-body').prepend(errorHtml);
                }
            });
        });

    });
</script>

@endsection