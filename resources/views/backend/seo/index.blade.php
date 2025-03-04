@extends('backend.layout.adminlayout')

@section('content')
<div class="card mt-4">
    <div class="card-header card-primary">
        <h3 class="card-title mt-4"> SEO </h3>
        @can('create field', \App\Models\Seo::class)
        <div class="card-tools mt-4">
            <a href="{{ route('seo.fieldcreate') }}" class="btn btn-success">
                create field <i class="fas fa-plus"></i>
            </a>
        </div>
        @endcan


    </div>

    @can('viewany', \App\Models\Seo::class)
    <div class="col-md mt-4">
        <!--begin::Quick Example-->
        <!--end::Header-->
        {!! Form::open(['route' => 'seo.update', 'method' => 'PUT']) !!}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Label</th>
                    <th>Field Type</th>
                    <th>Value</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seoFields as $seo)
                    <tr>
                        <td>
                            {!! Form::text("fields[{$seo->id}][label]", $seo->label, ['class' => 'form-control']) !!}
                        </td>
                        <td>
                            {!! Form::select(
                                "fields[{$seo->id}][type]",
                                ['text' => 'Text', 'textarea' => 'Textarea', 'number' => 'Number'],
                                $seo->type,
                                ['class' => 'fieldtype form-control','data-id'=>$seo->id],
                            ) !!}
                        </td>
                        <td>
                            @if ($seo->type == 'text')
                                {!! Form::text("fields[{$seo->id}][value]", $seo->value, ['class' => 'form-control']) !!}
                            @elseif ($seo->type == 'textarea')
                                {{-- {!! Form::textarea("fields[{$seo->id}][value]", $seo->value, ['class' => 'form-control tiny-mce']) !!} --}}
                                {!! Form::textarea("fields[{$seo->id}][value]", $seo->value, [
                                    'class' => 'form-control description',
                                    'id' => 'Description',
                                    'rows' => 5,
                                ]) !!}
                            @elseif ($seo->type == 'number')
                                {!! Form::number("fields[{$seo->id}][value]", $seo->value, [
                                    'class' => 'form-control number-field',
                                    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')",
                                    'step' => 'any',
                                ]) !!}
                            @endif
                        </td>
                        <td>
                            @can('delete seo', \App\Models\Seo::class)
                            <button type="button" class="delete-btn btn btn-danger delete-field"
                                data-id="{{ $seo->id }}">Delete</button>
                                @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @can('edit seo', \App\Models\Seo::class)
                            <button type="submit" class="btn btn-primary">Save</button>
                            @endcan
        {!! Form::close() !!}  
      

        <div class="d-flex justify-content-center mt-4">
            {{ $seoFields->links('pagination::bootstrap-4') }}
        </div>
    </div>
    @endcan
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
                        url: '/seo/delete/' + postId,

                        success: function(response) {

                            // SweetAlert2 success popup
                            Swal.fire({
                                title: 'Success!',
                                text: 'The item deleted sucessfully.',
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
                                text: 'An error occurred while deleting the item.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }

            });
        });

        
        });
       
    // $('.fieldtype').on('change',function(){
    //   var seoId=$(this).data('id');
    //   console.log(seoId);
    //   var fieldType = $(this).val();
    //   console.log(fieldType);
    //   $.ajax({
    //                     method: 'POST',
    //                     url: '/seofield/update',
    //                     data:{
    //                         '_token': '{{csrf_token()}}',
    //                         'id':seoId,
    //                         'fieldType':fieldType ,
    //                     },
    //                     success: function(response) {

    //                         // SweetAlert2 success popup
    //                         Swal.fire({
    //                             title: 'Success!',
    //                             text: 'The field updated sucessfully.',
    //                             icon: 'success',
    //                             confirmButtonText: 'OK'
    //                         }).then(() => {
    //                             location.reload();
    //                             // Remove the post element from the DOM (you can select the post by its ID or class)
    //                             $('#post-' + postId).remove(); // Assuming each post has an id like "post-1", "post-2", etc.
    //                         });
    //                     },
    //                     error: function(xhr, status, error) {
    //                         // Handle any errors
    //                         Swal.fire({
    //                             title: 'Error!',
    //                             text: 'An error occurred while updating the field.',
    //                             icon: 'error',
    //                             confirmButtonText: 'OK'
    //                         });
    //                     }
    //                 });
    // });
    
    </script>

@endsection