<footer>
    <div class="bg2 p-t-40 p-b-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 p-b-20">
                    <div class="size-h-3 flex-s-c">
                        <a href="{{route('front.home')}}">
                            <img class="max-s-full" src="{{asset('imagesfrontend/icons/logo-02.png')}}" alt="LOGO">
                        </a>
                    </div>

                    <div>
                        @if(isset($seo['description']) && isset($seo['description']->value))
                        <p class="f1-s-1 cl11 p-b-16">
                            {{Str::limit($seo['description']->value,200) }}
                        </p>
                        @endif
                        @if(isset($seo['number']) && isset($seo['number']->value))
                        <p class="f1-s-1 cl11 p-b-16">
                            Any questions? Call us on {{ $seo['number']->value }}
                        </p>
                        @endif
                        <div class="p-t-15">
                            @if(isset($seo['facebook']) && isset($seo['facebook']->value))
                            <a href="{{ $seo['facebook']->value }}" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-facebook-f"></span>
                            </a>
                            @endif

                            @if(isset($seo['instagram']) && isset($seo['instagram']->value))
                            <a href="{{ $seo['instagram']->value }}" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-instagram"></span>
                            </a>
                            @endif

                            @if(isset($seo['youtube']) && isset($seo['youtube']->value ))
                            <a href="{{ $seo['youtube']->value }}" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-youtube"></span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 p-b-20">
                    <div class="size-h-3 flex-s-c">
                        <h5 class="f1-m-7 cl0">
                            Latest Posts
                        </h5>
                    </div>

                    <ul>
                        @foreach($latestPosts as $post)
                        @if($post)
                        <li class="flex-wr-sb-s p-b-20">
                            @if($post->image)
                            <a href="#" class="size-w-4 wrap-pic-w hov1 trans-03">
                                <img src="{{  asset('images/post/' . $post->image) }}" alt="{{ $post->title }}">
                            </a>
                            @else
                            <img src="{{asset('imagesfrontend/popular-post-03.jpg')}}" alt="IMG">
                            @endif
                            <div class="size-w-5">
                                <h6 class="p-b-5">
                                    <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03">
                                        {{ Str::limit($post->Title, 50) }}
                                    </a>
                                </h6>

                                <span class="f1-s-3 cl6">
                                    {{ $post->created_at->format('M d') }}
                                </span>
                            </div>
                        </li>
                        @else
                        <h6 class="p-b-5">
                            <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03">
                                No Post
                            </a>
                        </h6>
                        @endif
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- COPYRIGHT BAR -->
    <div class="bg11">
        <div class="container size-h-4 flex-c-c p-tb-15">
            <span class="f1-s-1 cl0 txt-center">

                @if(isset($seo['copyright_link']) && isset($seo['copyright_link']->value) && isset($seo['copyright_title']) && isset($seo['copyright_title']->value))
                <a href="#" class="f1-s-1 cl10 hov-link1"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | by <a href="{{$seo['copyright_link']->value}}" target="_blank">{{$seo['copyright_title']->value}}</a>
                    @endif
               

            </span>
        </div>
    </div>
</footer>