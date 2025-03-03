@extends('backend.layout.adminlayout')

@section('content')
<!-- SweetAlert for session success message -->
<!-- Store Success Message in a Hidden Input Field -->

<!-- <div class="success">
        @if (session('success'))
            <div class='container alert alert-success mt-4'>{{ session('success') }}</div>
        @endif
    </div> -->

<div class="card-header mt-4">
    <h3 class="card-title">Slider List</h3>
    <div class="card-tools">
        <!-- <div class="input-group input-group-sm" style="width: 150px;"> -->
        <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search" /> -->

        <div class="input-group-append">
            <a href="{{route('slider.create')}}" type="submit" class="btn btn-success">
                Add New Slider <i class="fas fa-plus"></i>
            </a>

        </div>
        <!-- </div> -->
    </div>
</div>

<div class="card-body">
    <table class="table table-bordered table-striped mt-4">
        <thead class="table table-dark">
            <tr class="table">
                <!-- <th style="width: 10px"></th> -->
                <th>S.N.</th>
                <th>Name</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
            @endphp
            @foreach ($sliderdata as $slider)
            <tr class="align-middle">
                <td>{{ $i++ }}</td>
                <td>{{ $slider->name}}</td>
                <td>@if ($slider->image)
                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Current Image"  width="80"height="80">
                    @else
                    <img src="{{ asset('adminlte/img/avatar.png')  }}" class="img-circle" alt="User Image" width="80" height="80">
                    @endif
                </td>
               
                <td>
                    <div class="form-group">
                        <!-- Toggle switch for Publish/Unpublish -->
                        <input type="hidden" name="Status" class="Status" value="0">
                        <input type="checkbox" name="Status" class="Status"
                            data-id="{{ $slider->id }}"
                            data-toggle="toggle"
                            data-on="Publish"
                            data-off="Unpublish"
                            data-onstyle="success"
                            data-offstyle="danger"
                            value="1"
                            {{ $slider['published'] ? 'checked' : '' }}>
                    </div>
                </td>
                <td>
                <a href="{{ route('slider.edit',  $slider->id) }}" class="btn btn-primary btn-sm me-2 d-inline">
                        <i class="fas fa-pencil-alt"></i> <b>Edit</b>
                    </a>
                    <!-- <a href="{{ route('slider.edit',  ['id' => $slider['id']]) }}" class="btn btn-primary btn-sm me-2 d-inline">
                        <i class="fas fa-pencil-alt"></i> <b>Edit</b>
                    </a> -->
                    <button id="delete" data-id="{{ $slider->id }}" class="delete-btn btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> <b>Delete</b>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
    <!-- Pagination -->
    <div class="card-footer clearfix">
    {{ $sliderdata->links('pagination::bootstrap-4') }}
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.Status').change(function() {
            var sliderId = $(this).data('id');
            console.log(sliderId);
            var Status = $(this).prop('checked') ? '1' : '0';
            console.log(Status);
            $.ajax({
                method: 'POST',
                url: '/slider/status/update/' + sliderId,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'Status': Status
                },
                success: function(response) {

                    // SweetAlert2 success popup
                    Swal.fire({
                        title: 'Success!',
                        text: 'The slider status has been updated.',
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
            var sliderId = $(this).data('id');
            console.log(sliderId);
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
                        url: '/slider/delete/' + sliderId,

                        success: function(response) {

                            // SweetAlert2 success popup
                            Swal.fire({
                                title: 'Success!',
                                text: 'The slider deleted sucessfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                                // Remove the post element from the DOM (you can select the post by its ID or class)
                                $('#post-' + sliderId).remove(); // Assuming each post has an id like "post-1", "post-2", etc.
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle any errors
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while deleting the slider.',
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