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

                    <a href="#" class="left-topbar-item">
                        Contact
                    </a>

                    <a href="#" class="left-topbar-item">
                        Sign up
                    </a>

                    <a href="#" class="left-topbar-item">
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

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo mobile -->
            <div class="logo-mobile">
                <a href="index.html"><img src="{{asset('imagesfrontend/icons/logo-01.png')}}" alt="IMG-LOGO"></a>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>
    </div>

    <!-- Logo and Banner -->
    <div class="wrap-logo container">
        <!-- Logo desktop -->
        <div class="logo">
            <a href="index.html"><img src="{{asset('imagesfrontend/icons/logo-01.png')}}" alt="LOGO"></a>
        </div>

        <!-- Banner -->
        <div class="banner-header">
            <a href="https://themewagon.com/themes/free-bootstrap-4-html5-news-website-template-magnews2/">
                <img src="{{asset('imagesfrontend/banner-01.jpg')}}" alt="IMG">
            </a>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="wrap-main-nav">
        <div class="main-nav">
            <!-- Menu desktop -->
            <nav class="menu-desktop">
                <a class="logo-stick" href="index.html">
                    <img src="{{asset('imagesfrontend/icons/logo-01.png')}}" alt="LOGO">
                </a>

                <ul class="main-menu">
                    <li class="main-menu-active">
                        <a href="index.html">Home</a>
                        <ul class="sub-menu">
                            <li><a href="index.html">Homepage v1</a></li>
                            <li><a href="home-02.html">Homepage v2</a></li>
                            <li><a href="home-03.html">Homepage v3</a></li>
                        </ul>
                    </li>

                    <li class="mega-menu-item">
                        <a href="category-01.html">About Us</a>
                        <ul class="sub-menu">
                          @foreach($pages as $page)
                            <li><a href="#">{{ $page->Page_title }}</a></li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Categories Loop -->
                    @foreach($categories->take(4) as $category)
                    <li class="mega-menu-item">
                        <a href="#">{{ $category->Title }}</a>
                    </li>
                    @endforeach

                    <!-- More Categories if count is greater than 7 -->
                    @if($categories->count() > 4)
                    <li class="mega-menu-item">
                        <a href="#">More</a>
                        <ul class="sub-menu">
                            @foreach($categories->skip(4) as $category)
                            <li><a href="#">{{ $category->Title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>
