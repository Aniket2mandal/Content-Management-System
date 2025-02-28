@extends('frontend.layout.app')

@section('content')
<section class="bg0 p-t-70">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
            <div class="f2-s-1 p-r-30 m-tb-6">
                <a href="{{ route('front.home') }}" class="text-muted text-decoration-none">
                    Home
                </a>
                <span class="mx-2"> </span>
                <a href="{{ route('front.authorpost', $authors->id) }}" class="text-muted text-decoration-none">
                    {{ $authors->Name }}
                </a>
                <span class="mx-2"> </span>
                @if ($authors && $authors->image)
                <img src="{{ asset('images/author/' . $authors->image) }}" class="rounded-circle" alt="Author Image" width="50" height="50">
                @else
                <img src="{{ asset('adminlte/img/avatar.png') }}" class="rounded-circle img-fluid" alt="User Image" width="80" height="80">
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
                    Posts by {{ $authors->Name }}
                </h2>
            </div>

            @foreach($posts as $post)
            <div class="col-md-6 mb-4">
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
                        <h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
                            <a href="{{ route('front.postdetail', $post->id) }}" class="text-dark hov-cl10 trans-03">
                                {{ $post->Title }}
                            </a>
                        </h3>

                        <span class="text-muted small">
                            @foreach($post->categories as $category)
                            <a href="{{route('front.postlist', $category->id)}}" class="f1-s-4 cl8 hov-cl10 trans-03">{{ $category->Title }}</a>
                            <span class="mx-2"> </span>
                            @if($post->authors->isNotEmpty())
                            @foreach($post->authors as $author)
                            <a href="{{ route('front.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                by {{ $author->Name  }}
                            </a>
                            @endforeach
                            @else
                            <span class="text-muted">No Authors</span>
                            @endif
                            @endforeach
                            <span class="m-rl-3">-</span>
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                        </span>

                        <p class="mt-2 text-muted">
                            {!! Str::limit(strip_tags($post->Summary), 100) !!} </p>
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