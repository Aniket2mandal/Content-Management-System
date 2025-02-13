



{!! Form::open(['route' =>['page.edit',$page->id], 'method' => 'PUT','id'=>'eventeditForm'])!!}
@csrf
<!--begin::Body-->
<div class="card-body">
    @include('backend.pages.pageform')
</div>
<!--end::Body-->

<!--begin::Footer-->
<div class="card-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <!-- <a href="{{ route('page.index') }}" class="btn btn-danger" id="cancelButton">Cancel</a> -->
</div>
<!--end::Footer-->
{!! Form::close() !!}