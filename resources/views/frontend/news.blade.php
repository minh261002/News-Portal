@extends('frontend.layouts.master')

@section('content')
    <section class="blog_pages">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="{{ url('/') }}" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> {{ __('Trang chủ') }}</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="javascirt:;" class="breadcrumbs__url">{{ __('Bài viết') }}</a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="blog_page_search">
                        <form action="{{ route('news') }}" method="GET">
                            <div class="row">
                                <div class="col-lg-5">
                                    <input type="text" placeholder="{{ _('Tìm kiếm') }}" value="{{ request()->search }}"
                                        name="search">
                                </div>
                                <div class="col-lg-4">
                                    <select name="category">
                                        <option value="">{{ __('Tất cả') }}</option>
                                        @foreach ($categories as $category)
                                            <option {{ $category->slug === request()->category ? 'selected' : '' }}
                                                value="{{ $category->slug }}">{{ $category->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit">{{ __('Tìm kiếm') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <aside class="wrapper__list__article ">
                        @if (request()->has('category'))
                            <h4 class="border_section">{{ __('Danh mục') }}: {{ request()->category }}</h4>
                        @endif

                        <div class="row">
                            @foreach ($news as $post)
                                <div class="col-lg-6">
                                    <!-- Post Article -->
                                    <div class="article__entry">
                                        <div class="article__image">
                                            <a href="{{ route('news.detail', $post->slug) }}">
                                                <img src="{{ asset($post->image) }}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="article__content">
                                            <div class="article__category">
                                                {{ $post->category->name }}
                                            </div>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <span class="text-primary">
                                                        {{ $post->author->name }}
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span class="text-dark text-capitalize">
                                                        {{ date('M d, Y', strtotime($post->created_at)) }}
                                                    </span>
                                                </li>

                                            </ul>
                                            <h5>
                                                <a href="{{ route('news.detail', $post->slug) }}">
                                                    {!! truncate($post->title) !!}
                                                </a>
                                            </h5>
                                            <p>
                                                {!! truncate($post->content, 100) !!}
                                            </p>
                                            <a href="{{ route('news.detail', $post->slug) }}"
                                                class="btn btn-outline-primary mb-4 text-capitalize">
                                                {{ __('Xem chi tiết') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if (count($news) === 0)
                                <div class="text-center w-100">
                                    <h4>{{ __('Không tìm thấy kết quả phù hợp') }} </h4>
                                </div>
                            @endif
                        </div>

                    </aside>
                    <div class="text-center" style="display: flex;
                justify-content: center;">
                        <!-- Pagination -->
                        {{ $news->appends(request()->query())->links() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sidebar-sticky">
                        <aside class="wrapper__list__article ">
                            <h4 class="border_section">{{ __('Bài viết liên quan') }}</h4>
                            <div class="wrapper__list__article-small">
                                @foreach ($recentNews as $news)
                                    @if ($loop->index <= 2)
                                        <div class="mb-3">
                                            <!-- Post Article -->
                                            <div class="card__post card__post-list">
                                                <div class="image-sm">
                                                    <a href="{{ route('news.detail', $news->slug) }}">
                                                        <img src="{{ asset($news->image) }}" class="img-fluid"
                                                            alt="">
                                                    </a>
                                                </div>


                                                <div class="card__post__body ">
                                                    <div class="card__post__content">

                                                        <div class="card__post__author-info mb-2">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <span class="text-primary">
                                                                        {{ $news->author->name }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span class="text-dark text-capitalize">
                                                                        {{ date('M d, Y', strtotime($news->created_at)) }}
                                                                    </span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ route('news.detail', $news->slug) }}">
                                                                    {!! truncate($news->title) !!}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach ($recentNews as $news)
                                    @if ($loop->index > 2)
                                        <!-- Post Article -->
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="{{ route('news.detail', $news->slug) }}">
                                                    <img src="{{ asset($news->image) }}" alt="" class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="article__content">
                                                <div class="article__category">
                                                    {{ $news->category->name }}
                                                </div>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            {{ $news->author->name }}
                                                        </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span class="text-dark text-capitalize">
                                                            {{ date('M d, Y', strtotime($news->created_at)) }}
                                                        </span>
                                                    </li>

                                                </ul>
                                                <h5>
                                                    <a href="{{ route('news.detail', $news->slug) }}">
                                                        {!! truncate($news->title) !!}
                                                    </a>
                                                </h5>
                                                <p>
                                                    {!! truncate($news->content, 100) !!}
                                                </p>
                                                <a href="{{ route('news.detail', $news->slug) }}"
                                                    class="btn btn-outline-primary mb-4 text-capitalize">
                                                    {{ __('Xem chi tiết') }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('Tags') }}</h4>
                            <div class="blog-tags p-0">
                                <ul class="list-inline">
                                    @foreach ($mostCommonTags as $tag)
                                        <li class="list-inline-item">
                                            <a href="{{ route('news', ['tag' => $tag->name]) }}">
                                                #{{ $tag->name }}
                                            </a>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section mt-5">{{ __('Đăng ký nhận tin') }}</h4>
                            <!-- Form Subscribe -->
                            <form class="widget__form-subscribe bg__card-shadow" id="form-newsletter">
                                @csrf
                                <h6>
                                    {{ _('Nhận bản tin hàng ngày từ chúng tôi') }}
                                </h6>
                                <p><small>
                                        {{ _('Vui lòng nhập email của bạn') }}
                                    </small></p>
                                <div class="input-group ">
                                    <input type="email" class="form-control" placeholder="{{ _('Địa chỉ email') }}"
                                        name="email" id="newsletter-email">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            {{ _('Đăng ký') }}
                                        </button>
                                    </div>

                                    <span class="text-danger" id="emailErr"></span>
                                </div>
                            </form>
                        </aside>

                        @if ($ads->side_bar_ad_status == 1)
                            <aside class="wrapper__list__article mt-5">
                                <h4 class="border_section">{{ __('Quảng Cáo') }}</h4>
                                <a href="{{ $ads->side_bar_ad_url }}">
                                    <figure>
                                        <img src="{{ asset($ads->side_bar_ad) }}" alt="" class="img-fluid">
                                    </figure>
                                </a>
                            </aside>
                        @endif
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        @if ($ads->news_page_ad_status == 1)
            <div class="large_add_banner my-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="large_add_banner_img">
                                <a href="{{ $ads->news_page_ad_url }}">
                                    <img src="{{ asset($ads->news_page_ad) }}" alt="adds">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
