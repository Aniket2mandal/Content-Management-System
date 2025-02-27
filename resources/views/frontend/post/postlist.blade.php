@extends('frontend.layout.app')

@section('content')
<section class="bg0 p-t-70">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
            <div class="f2-s-1 p-r-30 m-tb-6">
                <a href="{{ route('front.home') }}" class="breadcrumb-item f1-s-3 cl9">
                    Home
                </a>

                @if(isset($categories))
                    <a href="{{route('front.postlist', $categories->id)}}" class="breadcrumb-item f1-s-3 cl9">
                        {{ $categories->Title }}
                    </a>
                @endif
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

        <!-- Main Content (Post Listing) -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="f1-m-2 cl12 mb-4 font-weight-bold text-dark" style="font-size: 35px;">
                    {{ $categories->Title ?? 'Posts' }}
                </h2>
            </div>

            @foreach($posts as $post) <!-- Loop through posts -->
            <div class="col-md-6 mb-4"> <!-- Adjust column width for better layout -->
                <div class="card border-0 shadow-sm">
                    <a href="{{ route('front.postdetail', $post->id) }}" class="d-block">
                        @if($post->image)
                            <img src="{{ asset('images/post/'.$post->image) }}" alt="IMG" class="card-img-top rounded-top" style="height: 300px; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light text-muted" style="height: 300px;">
                                <i class="fa fa-image" style="font-size: 50px;"></i>
                            </div>
                        @endif
                    </a>

                    <div class="card-body p-3">
                        <h5 class="card-title">
                            <a href="{{ route('front.postdetail', $post->id) }}" class="text-dark hov-cl10 trans-03">
                                {{ $post->Title }}
                            </a>
                        </h5>

                        <span class="text-muted small">
                            <a href="#" class="text-secondary">{{ $categories->Title ?? 'Uncategorized' }}</a>
                            <span class="mx-2">•</span>
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                        </span>

                        <p class="mt-2 text-muted">
                        {!! Str::limit(strip_tags($post->Description), 100) !!}
                        </p>

                        <span class="text-muted small">
                            <strong>Authors:</strong>
                            @foreach($post->authors as $author)
                                <a href="{{ route('front.authorpost', $author->id) }}" class="text-primary">{{ $author->Name }}</a>
                                @if(!$loop->last), @endif
                            @endforeach
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>
@endsection
