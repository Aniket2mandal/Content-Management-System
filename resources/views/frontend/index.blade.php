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


<section class="bg0 p-t-70">
	<div class="container">
		<div class="row justify-content-center">
			<!-- Main Content (Left Side) -->
			<div class="col-md-8 col-lg-8">
				<div class="p-b-20">
					<!-- Category-wise Posts -->
					@foreach($categories as $category)
					<div class="tab01 p-b-20">
						<div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
							<h3 class="f1-m-2 cl12 tab01-title">
								{{ $category->Title }}
							</h3>
						</div>
						<div class="tab-content p-t-35">
							<div class="tab-pane fade show active">
								<div class="row">
									@foreach($category->posts as $post)
									<div class="col-sm-6 p-r-25 p-r-15-sr991">
										<div class="m-b-30">
											<a href="" class="wrap-pic-w hov1 trans-03">
												@if($post->image)
												<img src="{{ asset('images/post/'.$post->image) }}" alt="IMG">
												@else
												<i class="fa fa-image" style="font-size: 50px;width: 300px; height: 300px; object-fit: cover; color: gray;"></i>
												@endif
											</a>
											<div class="p-t-20">
												<h5 class="p-b-5">
													<a href="" class="f1-m-3 cl2 hov-cl10 trans-03">
														{{ $post->Title }}
													</a>
												</h5>
												<span class="cl8">
													<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
														{{ $category->Title }}
													</a>
													<span class="f1-s-3 m-rl-3"> - </span>
													<span class="f1-s-3">{{ $post->created_at->format('M d, Y') }}</span>
												</span>
												<p class="f1-s-3">
													<a href="" class="f1-s-3 cl2 hov-cl10 trans-03">
														{{  Str::limit($post->Description, 100) }}
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
					@endforeach
				</div>
			</div>

			<!-- Latest Post Section (Right Side) -->
			<div class="col-md-4 col-lg-4">
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
										<a href="" class="wrap-pic-w hov1 trans-03">
											@if($latestPost->image)
											<img src="{{ asset('images/post/'.$latestPost->image) }}" alt="IMG">
											@else
											<i class="fa fa-image" style="font-size: 50px;width: 300px; height: 300px; object-fit: cover; color: gray;"></i>
											@endif
										</a>
										<div class="p-t-20">
											<h5 class="p-b-5">
												<a href="" class="f1-m-3 cl2 hov-cl10 trans-03">
													{{ $latestPost->Title }}
												</a>
											</h5>
											<span class="cl8">
												<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
													@foreach($latestPost->categories as $category)
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
			</div>
		</div>
	</div>
</section>





@endsection