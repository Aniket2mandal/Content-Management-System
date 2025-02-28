
<!-- Header -->
<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <div class="topbar">
            <div class="content-topbar container h-100">
                <div class="left-topbar">
                    <span class="left-topbar-item flex-wr-s-c">
                        <span>
                            New York, NY
                        </span>

                        <img class="m-b-1 m-rl-8" src="{{asset('imagesfrontend/icons/icon-night.png')}}" alt="IMG">

                        <span>
                            HI 58° LO 56°
                        </span>
                    </span>

                    <a href="#" class="left-topbar-item">
                        About
                    </a>

                    <a href="{{route('front.contactus')}}" class="left-topbar-item">
                        Contact
                    </a>

                    <a href="{{ route('register') }}" class="left-topbar-item">
                        Sign up
                    </a>

                    <a href="{{ route('login') }}" class="left-topbar-item">
                        Log in
                    </a>
                </div>

                <div class="right-topbar">
                    <a href="#">
                        <span class="fab fa-facebook-f"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-twitter"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-pinterest-p"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-vimeo-v"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-youtube"></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Logo and Banner -->
        <div class="wrap-logo container">
            <!-- Logo desktop -->
            <div class="logo">
                <a href="{{route('front.home')}}"><img src="{{asset('imagesfrontend/icons/logo-01.png')}}" alt="LOGO"></a>
            </div>

            <!-- Banner -->
            <div class="banner-header">
                <a href="https://themewagon.com/themes/free-bootstrap-4-html5-news-website-template-magnews2/">
                    <img src="{{asset('imagesfrontend/banner-01.jpg')}}" alt="IMG">
                </a>
            </div>
        </div>

        <!-- Menu Mobile -->

        <!--  -->
        <div class="wrap-main-nav">
            <div class="main-nav">
                <!-- Menu desktop -->
                <nav class="menu-desktop">
                    <ul class="main-menu">
                        <li class="main-menu-active">
                            <a href="{{route('front.home')}}">Home</a>
                        </li>

                        <li>
                            <a href="#">About Us</a>
                            <ul class="sub-menu">
                                @foreach($pages as $page)
                                @if($page->Page_title=='Contact page' )
                                <li><a href="{{route('front.contactus')}}">{{ $page->Page_title }}</a></li>
                                @elseif($page->Page_title=='About Page')
                                <li><a href="{{route('front.aboutus')}}">{{ $page->Page_title }}</a></li>
                                @else
                                <li><a href="#">{{ $page->Page_title }}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @foreach($categories->take(4) as $category)
                        <li>
                            <a href="{{route('front.postlist',$category->id)}}">{{ $category->Title }}</a>
                        </li>
                        @endforeach
                        <li>
                            <a href="#">More</a>
                            <ul class="sub-menu">
                                @if($categories->count() > 4)
                                        @foreach($categories->skip(4) as $category)
                                        <li><a href="{{route('front.postlist',$category->id)}}">{{ $category->Title }}</a></li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </li>
                             
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>