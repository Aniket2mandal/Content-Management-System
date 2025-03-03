@extends('frontend.layout.app')

@section('content')
<!-- Single Post Page -->
<section class="bg0 p-b-70 p-t-5">
    <!-- Hero Section -->
    <div class="bg-img1 size-a-18 how-overlay1"
        style="background-image: url('{{ asset('images/post/' . $posts->image) }}'); background-size: cover; background-position: center;">
        <div class="container h-full flex-col-e-c p-b-58">
            <!-- Category -->
            <a href="" class="f1-s-10 cl0 hov-cl10 trans-03 text-uppercase txt-center m-b-33">
                {{ $posts->categories->first()->Title ?? 'Uncategorized' }}
            </a>

            <!-- Post Title -->
            <h3 class="f1-l-5 cl0 p-b-16 txt-center respon2">
                {{ $posts->Title }}
            </h3>

            <!-- Post Meta -->
            <div class="flex-wr-c-s">
                <span class="f1-s-3 m-rl-7 txt-center" style="color: #fff;">
                    <a href="#" class="f1-s-4 hov-cl10 trans-03" style="color: #fff;">
                        by {{ $posts->authors->first()->Name ?? 'Unknown Author' }}
                    </a>
                    <span class="m-rl-3">-</span>
                    <span>
                        {{ $posts->created_at->format('M d, Y') }}
                    </span>
                </span>
            </div>

        </div>
    </div>

    <!-- Post Content & Banner -->
    <div class="container p-t-82">
        <div class="row">
            <!-- Post Content -->
            <div class="col-md-8 p-b-100">
                <div class="p-r-10 p-r-0-sr991">
                    <!-- Blog Detail -->
                    <div class="p-b-70">
                        <p class="f1-s-11 cl6 p-b-25">
                            {!! $posts->Description !!}
                        </p>
                    </div>
                </div>
            </div>
            <!-- Banner -->
            <div class="col-md-4 p-b-100">
                <div class="p-l-10 p-rl-0-sr991">
                    <!-- Banner -->

                    <div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                        <h3 class="f1-m-2 cl12 tab01-title">
                            Book Posts
                        </h3>
                    </div>
                    <div class="col-sm-12 p-r-25 p-r-15-sr991">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Post Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookpost->take(5) as $popular)
                            <tr>
                                <td>
                                    <a href="{{ route('front.postdetail', $popular->id) }}" class="text-muted text-decoration-none">
                                        {{ $popular->Title }}
                                    </a>
                                </td>
                                <td>
                                @if($popular->image)
                                <img src="{{ asset('images/post/'.$popular->image) }}" alt="IMG" class="card-img-top rounded-top" style="height: 50px; width:50px; object-fit: cover;">
                                @else
                                <div class="d-flex align-items-center justify-content-center bg-light text-muted" style="height: 300px;">
                                    <i class="fa fa-image" style="font-size: 50px;"></i>
                                </div>
                                @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                </div>
            </div>
        </div>
    </div>

</section>
@endsection