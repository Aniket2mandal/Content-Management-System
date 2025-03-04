<!-- Header -->
<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">


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

                        @if($pages->count() > 0)
                        <li>
                            @foreach($pages->take(1) as $page)
                            @if($page->Page_title != 'Contact page')
                            <a href="{{ route('front.pagedetail', $page->Page_slug) }}">
                                {{ $page->Page_title }}
                                @if($pages->count() > 1)
                                <span class="dropdown-icon">▼</span>
                                @endif
                            </a>
                            @else
                            <a href="{{ route('front.contactus') }}">
                                {{ $page->Page_title }}
                                @if($pages->count() > 1)
                                <span class="dropdown-icon">▼</span>
                                @endif
                            </a>
                            @endif
                            @endforeach

                            @if($pages->count() > 1)
                            <ul class="sub-menu">
                                @foreach($pages->skip(1) as $page)
                                @if($page->Page_title != 'Contact page')
                                <li><a href="{{ route('front.pagedetail',$page->Page_slug) }}">{{ $page->Page_title }}</a></li>
                                @endif
                                @endforeach
                                @foreach($pages->skip(1) as $page)
                                @if($page->Page_title == 'Contact page')
                                <li><a href="{{ route('front.contactus') }}">{{ $page->Page_title }}</a></li>
                                @endif
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endif


                        @foreach($categories->take(4) as $category)
                        <li>
                            <a href="{{ route('front.postlist', $category->id) }}">{{ $category->Title }}</a>
                        </li>
                        @endforeach

                        @if($categories->count() > 4)
                        <li>
                            <a href="#">
                                More
                                <span class="dropdown-icon">▼</span> <!-- Show dropdown icon only if more categories exist -->
                            </a>
                            <ul class="sub-menu">
                                @foreach($categories->skip(4) as $category)
                                <li><a href="{{ route('front.postlist', $category->id) }}">{{ $category->Title }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>