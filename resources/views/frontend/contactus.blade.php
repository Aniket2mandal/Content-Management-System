@extends('frontend.layout.app')

@section('content')

<!-- Breadcrumb -->
<div class="container">
    <div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
        <div class="f2-s-1 p-r-30 m-tb-6">
            <a href="{{route('front.home')}}" class="breadcrumb-item f1-s-3 cl9">
                Home
            </a>

            <span class="breadcrumb-item f1-s-3 cl9">
                Contact Us
            </span>
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
</div>

<!-- Page heading -->
<div class="container p-t-4 p-b-40">
    <h2 class="f1-l-1 cl2">
        Contact Us
    </h2>
</div>

<!-- Content -->
<section class="bg0 p-b-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-8 p-b-80">
                <div class="p-r-10 p-r-0-sr991">
                    <form action="{{route('front.contactstore')}}" method="POST">
                        @csrf
                        <input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="name" placeholder="Name*">
                        {{-- Error Message --}}
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="email" name="email" placeholder="Email*">
                        {{-- Error Message --}}
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="website" placeholder="Website">
                        {{-- Error Message --}}
                        @error('website')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="msg" placeholder="Your Message"></textarea>
                        {{-- Error Message --}}
                        @error('msg')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="size-a-20 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-20">
                            Send
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-5 col-lg-4 p-b-80">
                <div class="p-l-10 p-rl-0-sr991">
                    <!-- Popular Posts -->
                    <div>
                        <div class="how2 how2-cl4 flex-s-c">
                            <h3 class="f1-m-2 cl3 tab01-title">
                                Popular Post
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
                                    @foreach($posts->take(5) as $popular)
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
                                        </td>
                                        <td>

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
    </div>
</section>

@endsection