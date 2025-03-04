@extends('frontend.layout.app')

@section('content')
<!-- Post Listing Page -->
 
<section class="bg-light py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="d-flex justify-content-between align-items-center flex-wrap p-3 ">
            <div>
                <a href="{{ route('front.home') }}" class="text-secondary text-decoration-none">
                    Home
                </a>

                @foreach($posts->categories as $category)
                <span class="mx-2"> </span>
                <a href="{{route('front.postlist', $category->id)}}" class="text-muted text-decoration-none">{{ $category->Title }}</a>
                @endforeach
                <span class="mx-2"> </span>
                <a href="{{ route('front.postdetail', $posts->id) }}" class="text-muted text-decoration-none">{{ $posts->Title }}</a>


            </div>

            <form action="{{ route('front.postsearch') }}" method="GET">
                <div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
                    <input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Search">
                    <button type="submit" class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="p-b-70">


            <h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
                {{ $posts->Title }}
            </h3>

            <div class="flex-wr-s-s p-b-40">
                <span class="f1-s-3 cl8 m-r-15">
                    @foreach($posts->authors as $author)
                    <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                        by {{ $author->Name  }}
                    </a>
                    @endforeach
                    <span class="m-rl-3">-</span>

                    <span>
                        {{ $posts->created_at->format('M d, Y') }}
                    </span>
                </span>
            </div>

            <div class="wrap-pic-max-w p-b-30">
                @if($posts->image)
                <img src="{{ asset('images/post/'.$posts->image) }}"
                    alt="IMG"
                    class="img-fluid w-100"
                    style="height: 500px; object-fit: contain; max-width: 100%; border-radius: 8px;">
                @else
                <div class="d-flex align-items-center justify-content-center bg-light"
                    style="height: 500px; color: gray; border-radius: 8px;">
                    <i class="fa fa-image" style="font-size: 50px;"></i>
                </div>
                @endif
            </div>
            <!-- Main Content (Post Listing) -->
            <div class="row">
                <div class="col-md-12">

                    <!-- Post Description -->
                    <p class="text-dark ">
                        <a href="#" class="text-dark text-decoration-none">
                            {!! $posts->Description !!}
                        </a>
                    </p>
                    <hr class="my-4">


                </div>
            </div>



            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">

            </div>
        </div>
</section>
@endsection