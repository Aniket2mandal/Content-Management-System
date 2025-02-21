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
                        @foreach($categories as $category)
                        <li><a href="" style="color:grey;font-size: 15px">Category>{{ $category->Title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Main Content (Post Listing) -->
            <div class="col-md-8 col-lg-20 ">
                <div class="p-b-20">
                    @foreach($categories as $category) <!-- Loop through each category -->
                    <h2 class="f1-m-2 cl12 mb-5 font-weight-bold" style="color: black; font-size:35px">{{ $category->Title }}</h2>

                    <!-- Latest Posts -->
                    @foreach($category->posts as $post) <!-- Loop through the posts for the current category -->
                    <div class="m-b-30 d-flex align-items-start">
                        <div class="wrap-pic-w hov1 trans-03 mr-3">
                            <a href="{{route('front.postdetail',$post->id)}}">
                                @if($post->image)
                                <img src="{{ asset('images/post/'.$post->image) }}" alt="IMG" class="img-fluid rounded" style="width: 300px; height: 300px; object-fit: cover;">
                                @else
                                <i class="fa fa-image" style="font-size: 50px;width: 300px; height: 300px; object-fit: cover; color: gray;"></i>
                                @endif
                            </a>
                        </div>
                        <div class="p-t-20">
                            <h5 class="p-b-5">
                                <a href="" class="f1-m-3 cl2 hov-cl10 trans-03">
                                    {{ $post->Title }}
                                </a>
                            </h5>
                            <span class="cl8">
                                <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">{{ $category->Title }}</a>
                                <span class="f1-s-3 m-rl-3"> - </span>
                                <span class="f1-s-3">{{ $post->created_at->format('M d, Y') }}</span>
                            </span>
                            <p class="f1-s-3">
                                <a href="" class="f1-s-3 cl2 hov-cl10 trans-03">
                                    {{ Str::limit($post->Description, 100) }} <!-- Displaying first 100 chars of description -->
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