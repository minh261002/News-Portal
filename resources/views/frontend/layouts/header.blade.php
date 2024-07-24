@php
    $languages = \App\Models\Language::where('status', 1)->get();
    $categories = \App\Models\Category::where('status', 1)->where('show_at_nav', 1)->get();
@endphp

<!-- Header news -->
<header class="bg-light">
    <!-- Navbar  Top-->
    <div class="topbar d-none d-sm-block">
        <div class="container ">
            <div class="row">
                <div class="col-sm-6 col-md-8">
                    <div class="topbar-left topbar-right d-flex">

                        <ul class="topbar-sosmed p-0">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                        </ul>

                        <div class="topbar-text d-flex align-items-center justify-center gap-3">
                            <i class="fa fa-calendar"></i>
                            <p class="ml-3 mb-0" style="text-transform: uppercase;">
                                {{ \Carbon\Carbon::now()->translatedFormat('l, d-m-Y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="list-unstyled topbar-right d-flex align-items-center justify-content-end">
                        <div class="topbar_language">
                            <select id="site-language">
                                @foreach ($languages as $language)
                                    <option value="{{ $language->lang }}"
                                        {{ getLanguage() === $language->lang ? 'selected' : '' }}>
                                        @if ($language->lang === 'en')
                                            English
                                        @elseif($language->lang === 'vi')
                                            Tiếng Việt
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <ul class="topbar-link">
                            <li><a href="{{ route('login') }}">
                                    {{ _('Đăng Nhập') }}
                                </a></li>
                            <li><a href="{{ route('register') }}">
                                    {{ _('Đăng Ký') }}
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar Top  -->


    <!-- Navbar  -->
    <!-- Navbar menu  -->
    <div class="navigation-wraper navigation-shadow bg-white">
        <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
            <div class="container">
                <div class="offcanvas-header">
                    <div data-toggle="modal" data-target="#modal_aside_right" class="btn-md">
                        <span class="navbar-toggler-icon"></span>
                    </div>
                </div>
                <figure class="mb-0 mx-auto">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset($setting['site_logo']) }}" alt="" class="img-fluid logo">
                    </a>
                </figure>

                <div class="collapse navbar-collapse justify-content-between" id="main_nav99">
                    <ul class="navbar-nav ml-auto">
                        @foreach ($categories as $cat)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('news', ['category' => $cat->slug]) }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Search bar.// -->
                    <ul class="navbar-nav ">
                        <li class="nav-item search hidden-xs hidden-sm "> <a class="nav-link" href="#">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Search content bar.// -->
                    <div class="top-search navigation-shadow">
                        <div class="container">
                            <div class="input-group ">
                                <form action="{{ route('news') }}" method="GET">

                                    <div class="row no-gutters mt-3 position-relative">
                                        <div class="col">
                                            <input class="form-control border-secondary border-right-0 rounded-0"
                                                type="search" placeholder="{{ _('Tìm Kiếm') }} "
                                                id="example-search-input4" name="search">
                                        </div>
                                        <div class="col-auto position-absolute" style="right: 0">
                                            <button class="btn">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Search content bar.// -->
                </div> <!-- navbar-collapse.// -->
            </div>
        </nav>
    </div>
    <!-- End Navbar menu  -->


    <!-- Navbar sidebar menu  -->
    <div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-aside" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="widget__form-search-bar  ">
                        <div class="row no-gutters">
                            <div class="col">
                                <input class="form-control border-secondary border-right-0 rounded-0" value=""
                                    placeholder="Search">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav class="list-group list-group-flush">
                        <ul class="navbar-nav ">
                            @foreach ($categories as $cat)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('news', ['category' => $cat->slug]) }}">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </nav>
                </div>
                <div class="modal-footer">
                    <p>© 2024 OwenBookStore
                        -
                        <a href="#">Privacy</a>
                        -
                        <a href="#">Terms</a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Header news -->
