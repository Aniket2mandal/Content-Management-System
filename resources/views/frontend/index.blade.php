@extends('frontend.layout.app')

@section('content')
<!-- <div class="container">
		<div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 size-w-0 m-tb-6 flex-wr-s-c">
				<span class="text-uppercase cl2 p-r-8">
					Trending Now:
				</span>

				<span class="dis-inline-block cl6 slide100-txt pos-relative size-w-0" data-in="fadeInDown" data-out="fadeOutDown">
					<span class="dis-inline-block slide100-txt-item animated visible-false">
						Interest rate angst trips up US equity bull market
					</span>
					
					<span class="dis-inline-block slide100-txt-item animated visible-false">
						Designer fashion show kicks off Variety Week
					</span>

					<span class="dis-inline-block slide100-txt-item animated visible-false">
						Microsoft quisque at ipsum vel orci eleifend ultrices
					</span>
				</span>
			</div>

			<div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
				<input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Search">
				<button class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
					<i class="zmdi zmdi-search"></i>
				</button>
			</div>
		</div>
	</div> -->

<!-- Feature post -->
<!-- <section class="bg0">
		<div class="container">
			<div class="row m-rl--1">
				<div class="col-md-6 p-rl-1 p-b-2">
					<div class="bg-img1 size-a-3 how1 pos-relative" style="background-image: url(images/post-01.jpg);">
						<a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

						<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
							<a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
								Business
							</a>

							<h3 class="how1-child2 m-t-14 m-b-10">
								<a href="blog-detail-01.html" class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
									Microsoft quisque at ipsum vel orci eleifend ultrices
								</a>
							</h3>

							<span class="how1-child2">
								<span class="f1-s-4 cl11">
									Jack Sims
								</span>

								<span class="f1-s-3 cl11 m-rl-3">
									-
								</span>

								<span class="f1-s-3 cl11">
									Feb 16
								</span>
							</span>
						</div>
					</div>
				</div>

				<div class="col-md-6 p-rl-1">
					<div class="row m-rl--1">
						<div class="col-12 p-rl-1 p-b-2">
							<div class="bg-img1 size-a-4 how1 pos-relative" style="background-image: url(images/post-02.jpg);">
								<a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

								<div class="flex-col-e-s s-full p-rl-25 p-tb-24">
									<a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
										Culture
									</a>

									<h3 class="how1-child2 m-t-14">
										<a href="blog-detail-01.html" class="how-txt1 size-a-7 f1-l-2 cl0 hov-cl10 trans-03">
											London ipsum dolor sit amet, consectetur adipiscing elit.
										</a>
									</h3>
								</div>
							</div>
						</div>

						<div class="col-sm-6 p-rl-1 p-b-2">
							<div class="bg-img1 size-a-5 how1 pos-relative" style="background-image: url(images/post-03.jpg);">
								<a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

								<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
									<a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
										Life Style
									</a>

									<h3 class="how1-child2 m-t-14">
										<a href="blog-detail-01.html" class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03">
											Pellentesque dui nibh, pellen-tesque ut dapibus ut
										</a>
									</h3>
								</div>
							</div>
						</div>

						<div class="col-sm-6 p-rl-1 p-b-2">
							<div class="bg-img1 size-a-5 how1 pos-relative" style="background-image: url(images/post-04.jpg);">
								<a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

								<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
									<a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
										Sport
									</a>

									<h3 class="how1-child2 m-t-14">
										<a href="blog-detail-01.html" class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03">
											Motobike Vestibulum vene-natis purus nec nibh volutpat
										</a>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->

<!-- Post -->

<!-- SLIDER -->
@if(isset($sliders['sliders']))
<div class="container">
    <div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
        <div class="f2-s-1 p-r-30 size-w-0 m-tb-6 flex-wr-s-c">
            <span class="text-uppercase cl2 p-r-8">
                Trending Now:
            </span>

            <span class="dis-inline-block cl6 slide100-txt pos-relative size-w-0" data-in="fadeInDown" data-out="fadeOutDown">
                @foreach($sliders['sliders'] as $slider)
                @if($slider['published'] == 1)
                <span class="dis-inline-block slide100-txt-item animated visible-false">
                    {{$slider['name']}}
                </span>
                @endif
                @endforeach
            </span>

        </div>

        <div class="f2-s-1 p-r-30 size-w-0 m-tb-6 flex-wr-s-c">
            <span class="dis-inline-block cl6 slide100-txt pos-relative size-w-0" data-in="fadeInDown" data-out="fadeOutDown">
                @foreach($sliders['sliders'] as $slider)
                @if($slider['published'] == 1)
                <span class="dis-inline-block slide100-txt-item animated visible-false">

                    <div class="banner-header">
                        <a href={{$slider['url']}}  target="_blank">

                            @if($slider['image'])
                            <img src="{{ asset('storage/' . $slider['image']) }}" style="width:450px;height:100px; object-fit:cover" alt="IMG">
                            @else
                            <img src="" alt="IMG">
                            @endif

                        </a>
                    </div>
                </span>
                @endif
                @endforeach
            </span>
        </div>
    </div>

</div>
@endif

@if($categories && $categories->isNotEmpty())
<!-- FIRST CATEGORY -->
<section class="bg0 p-t-70">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Movie Category (Left Side) -->
            <div class="col-md-8 col-lg-8">
                <div class="p-b-20">
                    <!-- Category-wise Posts -->
                    @foreach($categories->take(1) as $category)
                    @if($category && $category->posts->isNotEmpty())
                    <div class="tab01 p-b-20">
                        <div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                            <h3 class="f1-m-2 cl12 tab01-title">
                                {{ $category->Title }}
                            </h3>
                        </div>
                        <div class="tab-content p-t-35">
                            <div class="tab-pane fade show active">
                                <div class="row">
                                    @foreach($category->posts->take(4) as $post)
                                    <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                        <div class="m-b-30">
                                            <a href="{{route('front.postdetail',$post->id)}}" class="wrap-pic-w hov1 trans-03">
                                                @if($post->image)
                                                <img src="{{ asset('images/post/'.$post->image) }}" style="width: 200px; height: 200px; object-fit: cover;" alt="IMG">
                                                @else
                                                <i class="fa fa-image" style="font-size: 50px; width:200px; height:200px; object-fit: cover; color: gray;"></i>
                                                @endif
                                            </a>
                                            <div class="p-t-20">
                                                <h3 class="p-b-5">
                                                    <a href="{{route('front.postdetail',$post->id)}}" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                        {{ $post->Title }}
                                                    </a>
                                                </h3>
                                                <!-- Post Meta -->
                                                <span class="text-muted small fixed-span">

                                                    <a href="{{route('front.postlist', $category->id)}}" class="f1-s-4 cl8 hov-cl10 trans-03">{{ $category->Title }}</a>
                                                    <span class="mx-2"> </span>
                                                    @if($post->authors->isNotEmpty())
                                                    @foreach($post->authors->take(2) as $author)
                                                    <a href="{{ route('front.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                        by {{ $author->Name  }}
                                                    </a>
                                                    @endforeach
                                                    @else
                                                    <span class="text-muted">No Authors</span>
                                                    @endif
                                                    <span class="m-rl-3">-</span>
                                                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                                                </span>

                                                <p class="f1-s-3 w-50">
                                                    <a href="{{route('front.postdetail',$post->id)}}" class="f1-s-3 cl2 hov-cl10 trans-03">
                                                        {!! Str::limit(strip_tags($post->Summary), 100) !!}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            <!-- Latest Post Section (Right Side) -->

            <div class="col-md-4 col-lg-4">
                <form action="{{ route('front.postsearch') }}" method="GET">
                    <div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
                        <input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Search">
                        <button type="submit" class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </div>
                </form>
                @if($latestPost)
                <div class="tab01 p-b-20">
                    <div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                        <h3 class="f1-m-2 cl12 tab01-title">
                            Latest Post
                        </h3>
                    </div>
                    <div class="tab-content p-t-35">
                        <div class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-sm-12 p-r-25 p-r-15-sr991">
                                    <div class="m-b-30">
                                        <a href="{{route('front.postdetail',$latestPost->id)}}" class="wrap-pic-w hov1 trans-03">
                                            @if($latestPost->image)
                                            <img src="{{ asset('images/post/'.$latestPost->image) }}" alt="IMG">
                                            @else
                                            <i class="fa fa-image" style="font-size: 50px;width: 300px; height: 300px; object-fit: cover; color: gray;"></i>
                                            @endif
                                        </a>
                                        <div class="p-t-20">
                                            <h5 class="p-b-5">
                                                <a href="{{route('front.postdetail',$latestPost->id)}}" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                    {{ $latestPost->Title }}
                                                </a>
                                            </h5>
                                            <span class="cl8">

                                                @foreach($latestPost->categories as $category)
                                                <a href="{{route('front.postlist',$category->id)}}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                    {{ $category->Title }}
                                                    @endforeach
                                                </a>
                                                <span class="f1-s-3 m-rl-3"> - </span>
                                                <span class="f1-s-3">{{ $latestPost->created_at->format('M d, Y') }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <h5 class="f1-s-3">
                    <a href="{{route('front.latestpostlist')}}" class="f1-s-3 cl2 hov-cl10 trans-03">
                        View All > ><!-- Displaying first 100 chars of description -->
                    </a>
                </h5>
            </div>

        </div>
    </div>
</section>
@endif

@if($categories && $categories->isNotEmpty())
<!-- SECOND CATEGORY -->
<section class="post bg0 p-t-85">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Left Side: Category Posts -->
            <div class="col-md-8 col-lg-8 p-b-25 m-r--10 m-r-0-sr991">
                @foreach($categories->skip(1)->take(1) as $category) <!-- Skip the first category -->
                @if($category && $category->posts->isNotEmpty())
                <div class="p-b-25">
                    <div class="how2 how2-cl1 flex-s-c">
                        <h3 class="f1-m-2 cl12 tab01-title">
                            {{ $category->Title }}
                        </h3>
                    </div>

                    <div class="flex-wr-sb-s p-t-35">
                        <div class="size-w-6 w-full-sr575">
                            <!-- First Post -->
                            @if($category->posts->isNotEmpty())
                            @php $firstPost = $category->posts->first(); @endphp
                            <div class="m-b-30">
                                <a href="{{ route('front.postdetail', $firstPost->id) }}" class="wrap-pic-w hov1 trans-03">
                                    @if($firstPost->image)
                                    <img src="{{ asset('images/post/'.$firstPost->image) }}" alt="IMG">
                                    @else
                                    <i class="fa fa-image" style="font-size: 200px; object-fit: cover; color: gray;"></i>
                                    @endif
                                </a>

                                <div class="p-t-25">
                                    <h5 class="p-b-5">
                                        <a href="{{ route('front.postdetail', $firstPost->id) }}" class="f1-m-3 cl2 hov-cl10 trans-03">
                                            {{ $firstPost->Title }}
                                        </a>
                                    </h5>

                                    <span class="text-muted small fixed-span">
                                        <a href="{{ route('front.postlist', $category->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            {{ $category->Title }}
                                        </a>

                                        <span class="f1-s-3 m-rl-3">-</span>

                                        <span class="f1-s-3">
                                            {{ $firstPost->created_at->format('M d, Y') }}
                                        </span>
                                    </span>

                                    <p class="f1-s-1 cl6 p-t-18">
                                        {!! Str::limit($firstPost->Description, 100) !!}
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="size-w-7 w-full-sr575">
                            <!-- Remaining Posts -->
                            @foreach($category->posts->skip(1)->take(3) as $post)
                            <div class="m-b-30">
                                <a href="{{ route('front.postdetail', $post->id) }}" class="wrap-pic-w hov1 trans-03">
                                    @if($post->image)
                                    <img src="{{ asset('images/post/'.$post->image) }}" style=" width: 150px; height: 100px; object-fit: cover;" alt="IMG">
                                    @else
                                    <i class="fa fa-image" style="font-size: 50px;width: 100%; height: 150px; object-fit: cover; color: gray;"></i>
                                    @endif
                                </a>

                                <div class="p-t-10">
                                    <h5 class="p-b-5">
                                        <a href="{{ route('front.postdetail', $post->id) }}" class="f1-s-5 cl3 hov-cl10 trans-03">
                                            {{ $post->Title }}
                                        </a>
                                    </h5>

                                    <span class="text-muted small fixed-span">
                                        <a href="{{ route('front.postlist', $category->id) }}" class="f1-s-6 cl8 hov-cl10 trans-03">
                                            {{ $category->Title }}
                                        </a>

                                        <span class="mx-1"> </span>
                                        @if($post->authors->isNotEmpty())
                                        @foreach($post->authors->take(2) as $author)
                                        <a href="{{ route('front.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            by {{ $author->Name  }}
                                        </a>
                                        @endforeach
                                        @else
                                        <span class="text-muted">No Authors</span>
                                        @endif

                                        <span class="f1-s-3 m-rl-3">-</span>

                                        <span class="f1-s-3">
                                            {{ $post->created_at->format('M d, Y') }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            <!-- Right Side: Latest Post -->
            <div class="col-md-4 col-lg-4">
                @if(count($categorieslist)>0)
                <div class="tab01 p-b-20">
                    <div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                        <h3 class="f1-m-2 cl12 tab01-title">
                            Latest Category
                        </h3>
                    </div>
                    <div class="tab-content p-t-35">
                        <div class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-sm-12 p-r-25 p-r-15-sr991">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Category Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categorieslist->take(5) as $category)
                                            <tr>
                                                <td><a href="{{ route('front.postlist', $category->id) }}" class="text-muted text-decoration-none"> {{ $category->Title }}</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif


@if($categories && $categories->isNotEmpty())
<!-- THIRD CATEGORY -->
<section class="post bg0 p-t-85 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="p-b-25 m-r--10 m-r-0-sr991">
                <!-- Dynamic Category -->
                @foreach($categories->skip(2)->take(1) as $category) <!-- Skip the first 2 categories -->
                @if($category && $category->posts->isNotEmpty())
                <div class="how2 how2-cl5 flex-s-c m-r-10 m-r-0-sr991">
                    <h3 class="f1-m-2 cl17 tab01-title">
                        {{ $category->Title }}
                    </h3>
                </div>

                <div class="row p-t-35">
                    <!-- First Two Posts -->
                    <div class="col-sm-12">
                        <div class="row">
                            @foreach($category->posts->take(2) as $post)
                            <div class="col-md-6 p-r-25 p-r-15-sr991 m-b-30">
                                <div class="d-flex align-items-center">
                                    <!-- Image Section -->
                                    <a href="{{ route('front.postdetail', $post->id) }}" class="wrap-pic-w hov1 trans-03" style="width: 40%;">
                                        @if($post->image)
                                        <img src="{{ asset('images/post/'.$post->image) }}" alt="IMG" style="width: 150px; height: 150px; ">
                                        @else
                                        <i class="fa fa-image" style="font-size: 150px; color: gray;"></i>
                                        @endif
                                    </a>

                                    <!-- Post Details -->
                                    <div class="size-w-2 p-l-15" style="width: 60%;">
                                        <h5 class="p-b-5">
                                            <a href="{{ route('front.postdetail', $post->id) }}" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                {{ $post->Title }}
                                            </a>
                                        </h5>

                                        <span class="text-muted small fixed-span">
                                            <a href="{{ route('front.postlist', $category->id) }}" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                {{ $category->Title }}
                                            </a>

                                            <span class="mx-1"> </span>
                                            @if($post->authors->isNotEmpty())
                                            @foreach($post->authors->take(2) as $author)
                                            <a href="{{ route('front.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                by {{ $author->Name  }}
                                            </a>
                                            @endforeach
                                            @else
                                            <span class="text-muted">No Authors</span>
                                            @endif

                                            <span class="f1-s-3 m-rl-3">-</span>
                                            <span class="f1-s-3">
                                                {{ $post->created_at->format('M d, Y') }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Remaining Posts (Only if more than 2 exist) -->

                    <div class="col-sm-12">
                        <div class="row">
                            @foreach($category->posts->skip(2)->take(2) as $post)
                            @if($post)
                            <div class="col-md-6 p-r-25 p-r-15-sr991 m-b-30">
                                <div class="d-flex align-items-center">
                                    <!-- Image Section -->
                                    <a href="{{ route('front.postdetail', $post->id) }}" class="wrap-pic-w hov1 trans-03" style="width: 40%;">
                                        @if($post->image)
                                        <img src="{{ asset('images/post/'.$post->image) }}" alt="IMG" style="width: 150px; height: 150px;">
                                        @else
                                        <i class="fa fa-image" style="font-size: 50px; width: 100%; height: 100px; color: gray;"></i>
                                        @endif
                                    </a>

                                    <!-- Post Details -->
                                    <div class="size-w-2 p-l-15" style="width: 60%;">
                                        <h5 class="p-b-5">
                                            <a href="{{ route('front.postdetail', $post->id) }}" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                {{ $post->Title }}
                                            </a>
                                        </h5>

                                        <span class="text-muted small fixed-span">
                                            <a href="{{ route('front.postlist', $category->id) }}" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                {{ $category->Title }}
                                            </a>
                                            <span class="mx-1"> </span>
                                            @if($post->authors->isNotEmpty())
                                            @foreach($post->authors->take(2) as $author)
                                            <a href="{{ route('front.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                by {{ $author->Name  }}
                                            </a>
                                            @endforeach
                                            @else
                                            <span class="text-muted">No Authors</span>
                                            @endif

                                            <span class="f1-s-3 m-rl-3">-</span>
                                            <span class="f1-s-3">
                                                {{ $post->created_at->format('M d, Y') }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @else
                            <span class="f1-s-3">
                                No Posts
                            </span>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

@if($categories && $categories->isNotEmpty())
<!-- FOURTH CATEGORY -->
<section class="post bg0 p-t-85">
    <div class="container">
        <div class="row justify-content-center">
            <!-- First Column (Business) -->
            <div class="col-sm-6 p-r-25 p-r-15-sr991 p-b-25">
                @php $category = $categories->skip(3)->take(1)->first(); @endphp
                @if($category && $category->posts->isNotEmpty())
                <div class="how2 how2-cl2 flex-sb-c m-b-35">
                    <h3 class="f1-m-2 cl13 tab01-title">
                        {{ $category->Title }}
                    </h3>

                    <a href="{{ route('front.postlist', $category->id) }}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                        View all
                        <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                    </a>
                </div>

                <!-- Main Item post -->
                @if($category->posts->isNotEmpty())
                <div class="m-b-30">
                    @php $firstPost = $category->posts->first(); @endphp
                    <a href="{{ route('front.postdetail', $firstPost->id) }}" class="wrap-pic-w hov1 trans-03">
                        @if($firstPost->image)
                        <img src="{{ asset('images/post/'.$firstPost->image) }}" style="font-size: 50px;width: 100%; height: 300px; object-fit: cover; color: gray;">
                        @else
                        <i class="fa fa-image fa-5x" style="display: block; text-align: center; color: gray;"></i>
                        @endif
                    </a>

                    <div class="p-t-20">
                        <h5 class="p-b-5">
                            <a href="{{ route('front.postdetail', $firstPost->id) }}" class="f1-m-3 cl2 hov-cl10 trans-03">
                                {{ $firstPost->Title }}
                            </a>
                        </h5>

                        <span class="text-muted small fixed-span">
                            <a href="{{ route('front.postlist', $category->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                {{ $category->Title }}
                            </a>
                            <span class="mx-1"> </span>
                            @if($post->authors->isNotEmpty())
                            @foreach($post->authors->take(2) as $author)
                            <a href="{{ route('front.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                by {{ $author->Name  }}
                            </a>
                            @endforeach
                            @else
                            <span class="text-muted">No Authors</span>
                            @endif
                            <span class="f1-s-3 m-rl-3">-</span>

                            <span class="f1-s-3">
                                {{ $firstPost->created_at->format('M d, Y') }}
                            </span>
                        </span>
                    </div>
                </div>
                @endif

                <!-- Loop through remaining posts in the category -->
                @foreach($category->posts->skip(1)->take(4) as $post) <!-- Skipping the first post -->
                <div class="flex-wr-sb-s m-b-30">
                    <a href="{{ route('front.postdetail', $post->id) }}" class="size-w-1 wrap-pic-w hov1 trans-03">
                        @if($post->image)
                        <img src="{{ asset('images/post/'.$post->image) }}" style="font-size: 50px;width: 100%; height: 300px; object-fit: cover; color: gray;">
                        @else
                        <i class="fa fa-image" style="font-size: 300px;"></i>
                        @endif
                    </a>

                    <div class="size-w-2">
                        <h5 class="p-b-5">
                            <a href="{{ route('front.postdetail', $post->id) }}" class="f1-s-5 cl3 hov-cl10 trans-03">
                                {{ $post->Title }}
                            </a>
                        </h5>

                        <span class="text-muted small fixed-span">
                            <a href="{{ route('front.postlist', $category->id) }}" class="f1-s-6 cl8 hov-cl10 trans-03">
                                {{ $category->Title }}
                            </a>
                            <span class="mx-1"> </span>
                            @if($post->authors->isNotEmpty())
                            @foreach($post->authors->take(2) as $author)
                            <a href="{{ route('front.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                by {{ $author->Name  }}
                            </a>
                            @endforeach
                            @else
                            <span class="text-muted">No Authors</span>
                            @endif

                            <span class="f1-s-3 m-rl-3">-</span>

                            <span class="f1-s-3">
                                {{ $post->created_at->format('M d, Y') }}
                            </span>
                        </span>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <!-- Second Column (Technology) -->
            <div class="col-sm-6 p-r-25 p-r-15-sr991 p-b-25">
                @php $category = $categories->skip(4)->take(1)->first(); @endphp
                @if($category && $category->posts->isNotEmpty())
                <div class="how2 how2-cl6 flex-sb-c m-b-35">
                    <h3 class="f1-m-2 cl18 tab01-title">
                        {{ $category->Title }}
                    </h3>

                    <a href="{{ route('front.postlist', $category->id) }}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                        View all
                        <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                    </a>
                </div>

                <!-- Main Item post -->
                @if($category->posts->isNotEmpty())
                <div class="m-b-30">
                    @php $firstPost = $category->posts->first(); @endphp
                    <a href="{{ route('front.postdetail', $firstPost->id) }}" class="wrap-pic-w hov1 trans-03">
                        @if($firstPost->image)
                        <img src="{{ asset('images/post/'.$firstPost->image) }}" style="font-size: 50px;width: 100%; height: 300px; object-fit: cover; color: gray;">
                        @else
                        <i class="fa fa-image" style="font-size: 300px;"></i>
                        @endif
                    </a>

                    <div class="p-t-20">
                        <h5 class="p-b-5">
                            <a href="{{ route('front.postdetail', $firstPost->id) }}" class="f1-m-3 cl2 hov-cl10 trans-03">
                                {{ $firstPost->Title }}
                            </a>
                        </h5>

                        <span class="text-muted small fixed-span">
                            <a href="{{ route('front.postlist', $category->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                {{ $category->Title }}
                            </a>
                            <span class="mx-1"> </span>
                            @if($post->authors->isNotEmpty())
                            @foreach($post->authors->take(2) as $author)
                            <a href="{{ route('front.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                by {{ $author->Name  }}
                            </a>
                            @endforeach
                            @else
                            <span class="text-muted">No Authors</span>
                            @endif

                            <span class="f1-s-3 m-rl-3">-</span>

                            <span class="f1-s-3">
                                {{ $firstPost->created_at->format('M d, Y') }}
                            </span>
                        </span>
                    </div>
                </div>
                @endif

                <!-- Loop through remaining posts in the category -->
                @foreach($category->posts->skip(1)->take(4) as $post) <!-- Skipping the first post -->
                <div class="flex-wr-sb-s m-b-30">
                    <a href="{{ route('front.postdetail', $post->id) }}" class="size-w-1 wrap-pic-w hov1 trans-03">
                        @if($post->image)
                        <img src="{{ asset('images/post/'.$post->image) }}" alt="IMG">
                        @else
                        <i class="fa fa-image" style="font-size: 50px;width: 100%; height: 150px; object-fit: cover; color: gray;"></i>
                        @endif
                    </a>

                    <div class="size-w-2">
                        <h5 class="p-b-5">
                            <a href="{{ route('front.postdetail', $post->id) }}" class="f1-s-5 cl3 hov-cl10 trans-03">
                                {{ $post->Title }}
                            </a>
                        </h5>

                        <span class="text-muted small fixed-span">
                            <a href="{{ route('front.postlist', $category->id) }}" class="f1-s-6 cl8 hov-cl10 trans-03">
                                {{ $category->Title }}
                            </a>

                            <span class="mx-1"> </span>
                            @if($post->authors->isNotEmpty())
                            @foreach($post->authors->take(2) as $author)
                            <a href="{{ route('front.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
                                by {{ $author->Name  }}
                            </a>
                            @endforeach
                            @else
                            <span class="text-muted">No Authors</span>
                            @endif

                            <span class="f1-s-3 m-rl-3">-</span>

                            <span class="f1-s-3">
                                {{ $post->created_at->format('M d, Y') }}
                            </span>
                        </span>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@endif

@if(count($testimonials)>0)
<!-- TESTIMONIAL -->
<section class="bg0 p-t-70">
    <div class="container">

        <div class="how2 how2-cl5 flex-s-c m-r-10 m-r-0-sr991">
            <h3 class="f1-m-2 cl17 tab01-title">
                Testimonials
            </h3>
        </div>
        <!-- Main Content (Testimonial Listing) -->
        <div class="row">
            @if($testimonials)
            @foreach($testimonials as $testimonial)
            @if($testimonial['published'] == 1) <!-- Only display published testimonials -->
            <div class="col-md-6 mb-4"> <!-- Adjust column width for better layout -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3 text-center">
                        <!-- Testimonial Image -->
                        <div class="mb-3">
                            @if($testimonial['image'])
                            <img src="{{ asset('storage/' . $testimonial['image']) }}" class="card-img-top rounded-top" alt="Testimonial Image" style="width:300px;height:300px;">
                            @else
                            <i class="fa fa-image" style="font-size: 300px;"></i>
                            @endif
                        </div>
                        <!-- Testimonial Content -->
                        <h3 class="f1-l-2 cl2 p-b-16 p-t-20 respon2">{{ $testimonial['name'] }}</h3>
                        <p class="card-text text-muted">{!! Str::limit(strip_tags($testimonial['message']), 100) !!}</p>

                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endif
        </div>
        <!-- Pagination (if necessary) -->
    </div>
</section>
@endif

@endsection