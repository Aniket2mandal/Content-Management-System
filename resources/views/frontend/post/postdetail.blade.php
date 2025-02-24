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
                @foreach($posts as $post)
                @foreach($post->categories as $category)
                <span class="mx-2"> </span>
                <a href="{{route('front.postlist', $category->id)}}" class="text-muted text-decoration-none">{{ $category->Title }}</a>
                <span class="mx-2"> </span>
                <a href="{{ route('front.postdetail', $post->id) }}" class="text-muted text-decoration-none">{{ $post->Title }}</a>
                @endforeach
                @endforeach
            </div>

            <div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
                <input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Search">
                <button class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </div>
        </div>

        <!-- Main Content (Post Listing) -->
        <div class="row">
            <div class="col-md-12">

                @foreach($posts as $post)
                @foreach($post->categories as $category)
                <!-- Post Image -->
                <div class="mb-4">
                    <div class="rounded shadow-sm">
                        @if($post->image)
                        <img src="{{ asset('images/post/'.$post->image) }}"
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
                </div>


                <!-- Post Title -->
                <h3 class="fw-bold text-primary">
                    {{ $post->Title }}
                </h3>

                <!-- Post Meta -->
                <p class="text-muted small">
                    <a href="{{ route('front.postlist', $category->id) }}" class="text-secondary text-decoration-none">
                        {{ $category->Title }}
                    </a>
                    <span class="mx-2">•</span>
                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                </p>

                <!-- Authors -->
                <p class="text-muted small">
                    <strong>Authors:</strong>
                    @foreach($post->authors as $author)
                    <a href="{{ route('front.authorpost', $author->id) }}" class="text-decoration-none text-primary">
                        {{ $author->Name }}
                    </a>
                    @if(!$loop->last), @endif
                    @endforeach
                </p>

                <!-- Post Description -->
                <p class="text-dark">
                    <a href="#" class="text-dark text-decoration-none">
                        {{ $post->Description }}
                    </a>
                </p>

                <hr class="my-4">
                @endforeach
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">

        </div>
    </div>
</section>
@endsection