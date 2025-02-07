@extends('Back.layout.adminlayout')

@section('content')

<div class="card mt-4">
    <div class="card-header ">
        <h3 class="card-title mt-4">Post List</h3>
       
        <div class="card-tools">
            <!-- <div class="input-group input-group-sm" style="width: 150px;"> -->
            <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search" /> -->
             @can('create', \App\Models\Post::class)
            <div class="input-group-append mt-4">
                <a href="{{route('post.create')}}" type="submit" class="btn btn-success">
                    Add New Post <i class="fas fa-plus"></i>
                </a>
            </div>
            @endcan
            <!-- </div> -->
        </div>
    </div>
    @can('viewany', \App\Models\Post::class)
 
    <div class="card-body ">
        <table class="table table-bordered table-striped mt-4">
            <thead class="table table-dark">
                <tr class=" table">
                    <!-- <th style="width: 10px"></th> -->
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Summary</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach($post as $posts)
                <tr class="align-middle">
                    <td>{{$i++}}</td>
                    <td>{{$posts->Title}}</td>
                    <td>{{$posts->Description}}</td>
                    <td>{{$posts->Summary}}</td>
                    <td>@if ($posts && $posts->image)
                        <img src="{{ asset('images/' . $posts->image) }}" alt="Post Image" width="80" height="80">
                        @else
                        <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" width="80" height="80">
                        @endif
                    </td>
                    <td>
                    @if ($posts->categories->isNotEmpty()) <!-- Check if there are authors -->
                        @foreach($posts->categories as $category)
                        {{ $category->Title }}
                        @endforeach
                        @else
                        No Category
                        @endif
                    </td>
                    <td>
                        @if ($posts->authors->isNotEmpty()) <!-- Check if there are authors -->
                        @foreach($posts->authors as $author)
                        {{ $author->Name }}
                        @endforeach
                        @else
                        No Author
                        @endif
                    </td>
                    <td>

                        <div class="form-group ">
                            <!-- Toggle switch (default checked for Active) -->
                            <input type="hidden" name="Status" class="Status" value="0">
                            <input type="checkbox" name="Status" class="Status" data-id="{{$posts->id}}" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" value="1" {{ old('Status',$posts->Status) ? 'checked' : '' }}>
                            <!-- <small class="form-text text-muted">Switch to set the status to active or inactive</small> -->
                        </div>
                   
                    </td>
                      
                    <td class="">
                    <!-- @if(auth()->user()->can('edit post')) -->
                     @can('edit',$post)
                        <a href="{{route('post.edit',$posts->id)}}" class="btn btn-primary btn-sm me-2 ">
                            <i class="fas fa-pencil-alt"></i> <b>Edit</b>
                        </a>
                        @endcan
                   <!-- @endif -->

                   @can('delete',$post)
                        <a href="{{route('post.delete',$posts->id)}}" class="btn btn-danger btn-sm ml-2 ">
                            <i class="fas fa-trash"></i> <b>Delete</b>
                        </a>
                    @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="card-footer clearfix">
            {{ $post->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endcan
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
    });
</script>

@endsection