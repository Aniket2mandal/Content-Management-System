@extends('frontend.layout.app')

@section('content')
<!-- Post Listing Page -->
<section class="bg0 p-t-70">
    <div class="container">
        <div class="justify-content-center">
            <!-- Sidebar (optional) -->
            <div class="col-md-4 col-lg-4 mb-4">
                <div class="p-b-20">
                    <!-- <h4 class="f1-m-2 cl12">Categories</h4> -->
                    <ul>
                        @foreach($posts as $post)
                        @foreach($post->categories as $category)
                        <li><a href="" style="color:grey;font-size: 15px">Category>{{ $category->Title }}>{{$post->Title}}</a></li>
                        @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Main Content (Post Listing) -->
            <div class="col-md-8 col-lg-20">
                <div class="p-b-20">
                    @foreach($posts as $post) <!-- Loop through each category -->
                    @foreach($post->categories as $category) <!-- Loop through the posts for the current category -->
                    <h2 class="f1-m-2 cl12 mb-5 font-weight-bold" style="color: black; font-size:20px">
                        {{ $category->Title }}
                    </h2>
                    <h5 class="p-b-5 font-weight-bold" style="color: black; font-size:35px">
                        {{ $post->Title }}
                    </h5>
                    <span class="cl8">
                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">{{ $category->Title }}</a>
                        <span class="f1-s-3 m-rl-3"> - </span>
                        <span class="f1-s-3">{{ $post->created_at->format('M d, Y') }}</span>
                    </span>
                    <!-- Post Container -->
                    <div class="m-b-30">
                        <!-- Image Section (Top) -->
                        <div class="wrap-pic-w hov1 trans-03 container-fluid p-0">
                            @if($post->image)
                            <img src="{{ asset('images/post/'.$post->image) }}"
                                alt="IMG"
                                class="img-fluid w-100"
                                style="height: auto; max-height: 500px; object-fit: contain;">
                            @else
                            <i class="fa fa-image d-block"
                                style="font-size: 50px; width: 100%; height: 400px; object-fit: contain; color: gray;"></i>
                            @endif
                        </div>


                        <!-- Content Section (Below) -->
                        <div class="p-t-20"> <!-- Removed text-center -->


                            <p class="f1-s-3 mt-3">
                                <a href="" class="f1-s-3 cl2 hov-cl10 trans-03">
                                    {{$post->Description }} <!-- Displaying first 100 chars of description -->
                                </a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                    @endforeach

                    <!-- Pagination (if applicable) -->
                </div>
            </div>



</section>
@endsection