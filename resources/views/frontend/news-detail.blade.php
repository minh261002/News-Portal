@extends('frontend.layouts.master')

@section('tags', $news->tags->pluck('name')->implode(','))
@section('title', $news->title)
@section('meta_description', $news->meta_description)
@section('meta_og_title', $news->meta_title)
@section('meta_og_description', $news->meta_description)
@section('meta_og_image', asset($news->image))
@section('meta_tw_title', $news->meta_title)
@section('meta_tw_description', $news->meta_description)
@section('meta_tw_image', asset($news->image))

@section('content')
    <section class="pb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- breaddcrumb -->
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="index.html" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> {{ _('Trang Chủ') }} </a>
                        </li>

                        <li class="breadcrumbs__item breadcrumbs__item--current">
                            {{ _($news->category->name) }}
                        </li>
                    </ul>
                    <!-- end breadcrumb -->
                </div>

                <div class="col-md-8">
                    <!-- content article detail -->
                    <!-- Article Detail -->
                    <div class="wrap__article-detail">
                        <div class="wrap__article-detail-title">
                            <h1>
                                {{ $news->title }}
                            </h1>
                        </div>
                        <hr>
                        <div class="wrap__article-detail-info">
                            <ul class="list-inline d-flex flex-wrap justify-content-start">
                                <li class="list-inline-item">
                                    {{ _('Đăng bởi') }}
                                    <a href="#">
                                        {{ $news->author->name }}
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <span class="text-dark text-capitalize ml-1">
                                        {{ $news->created_at->format('d M, Y') }}
                                    </span>
                                </li>
                                <li class="list-inline-item">
                                    <span class="text-dark text-capitalize">
                                        {{ _('Danh mục') }}
                                    </span>
                                    <a href="#">
                                        {{ $news->category->name }}
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="wrap__article-detail-image mt-4">
                            <figure>
                                <img src="{{ asset($news->image) }}" alt="" class="img-fluid">
                            </figure>
                        </div>
                        <div class="wrap__article-detail-content">
                            <div class="total-views">
                                <div class="total-views-read">
                                    {{ $news->views }}
                                    <span>
                                        {{ _('Lượt xem') }}
                                    </span>
                                </div>

                                <ul class="list-inline">
                                    <span class="share">{{ _('Chia sẻ:') }}</span>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o facebook" target="_blank"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}">
                                            <i class="fa fa-facebook-f"></i>
                                            <span>Facebook</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o twitter" target="_blank"
                                            href="https://twitter.com/intent/tweet?url={{ url()->current() }}">
                                            <i class="fa fa-twitter"></i>
                                            <span>twitter</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="wrap__article-detail-content-text">
                                {!! $news->content !!}
                            </div>
                        </div>


                    </div>
                    <!-- end content article detail -->

                    <!-- tags -->
                    <!-- News Tags -->
                    <div class="blog-tags">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <i class="fa fa-tags">
                                </i>
                            </li>
                            @forelse ($news->tags as $tag)
                                <li class="list-inline-item">
                                    <a href="#">
                                        #{{ $tag->name }}
                                    </a>
                                </li>
                            @empty
                                <div class="alert alert-warning">
                                    {{ _('Không có thẻ nào') }}
                                </div>
                            @endforelse
                        </ul>
                    </div>
                    <!-- end tags-->

                    <!-- authors-->
                    <!-- Profile author -->
                    <div class="wrap__profile">
                        <div class="wrap__profile-author">
                            <figure>
                                <img src="{{ asset($news->author->image) }}"
                                    style="width:200px !important;height:200px !important;border-radius:50%;object-fit:cover">
                            </figure>
                            <div class="wrap__profile-author-detail">
                                <div class="wrap__profile-author-detail-name">{{ _('Tác giả') }}</div>
                                <h4>{{ $news->author->name }}</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis laboriosam ad
                                    beatae itaque ea non
                                    placeat officia ipsum praesentium! Ullam?</p>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o facebook ">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o twitter ">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o instagram ">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o telegram ">
                                            <i class="fa fa-telegram"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o linkedin ">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end author-->

                    <!-- Comment  -->
                    <div id="comments" class="comments-area">
                        <h3 class="comments-title">
                            {{ $news->comments()->whereNull('parent_id')->count() }} {{ _('Bình Luận') }}
                        </h3>

                        <ol class="comment-list">
                            @foreach ($news->comments()->whereNull('parent_id')->get() as $comment)
                                <li class="comment">
                                    <aside class="comment-body">
                                        <div class="comment-meta">
                                            <div class="comment-author vcard">
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWwfGUCDwrZZK12xVpCOqngxSpn0BDpq6ewQ&s"
                                                    class="avatar" alt="image">
                                                <b class="fn">{{ $comment->user->name }}</b>
                                                <span class="says">says:</span>
                                            </div>

                                            <div class="comment-metadata">
                                                <a href="#">
                                                    {{-- <span>April 24, 2019 at 10:59 am</span> --}}
                                                    <span>{{ $comment->created_at->format('d M, Y') }}</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="comment-content">
                                            <p>{{ $comment->comment }}
                                            </p>
                                        </div>

                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <a href="#" class="comment-reply-link" data-toggle="modal"
                                                data-target="#exampleModal{{ $comment->id }}">
                                                <i class="fa fa-reply" style="font-size: 24px"></i>
                                            </a>
                                            {{-- <span>
                                                <i class="fa fa-trash"></i>
                                            </span> --}}

                                            @if (auth()->check() && auth()->user()->id === $comment->user_id)
                                                <span>
                                                    <a href="{{ route('deleteComment', $comment->id) }}"
                                                        class="delete-item text-danger">
                                                        <i class="fa fa-trash" style="font-size: 24px"></i>
                                                    </a>
                                                </span>
                                            @endif
                                        </div>
                                    </aside>


                                    @if ($comment->children->count() > 0)
                                        @foreach ($comment->children as $reply)
                                            <ol class="children">
                                                <li class="comment">
                                                    <aside class="comment-body">
                                                        <div class="comment-meta">
                                                            <div class="comment-author vcard">
                                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWwfGUCDwrZZK12xVpCOqngxSpn0BDpq6ewQ&s"
                                                                    class="avatar" alt="image">
                                                                <b class="fn">{{ $reply->user->name }}</b>
                                                                <span class="says">says:</span>
                                                            </div>

                                                            <div class="comment-metadata">
                                                                <a href="#">
                                                                    {{-- <span>April 24, 2019 at 10:59 am</span> --}}
                                                                    <span>{{ $reply->created_at->format('d M, Y') }}</span>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="comment-content">
                                                            <p>{{ $reply->comment }}
                                                            </p>
                                                        </div>

                                                        <div
                                                            style="display: flex; justify-content: space-between; align-items: center;">
                                                            <div></div>
                                                            {{-- <span>
                                                                <i class="fa fa-trash"></i>
                                                            </span> --}}

                                                            @if (auth()->check() && auth()->user()->id === $reply->user_id)
                                                                <span>
                                                                    <a href="{{ route('deleteComment', $reply->id) }}"
                                                                        class="delete-item text-danger">
                                                                        <i class="fa fa-trash"
                                                                            style="font-size: 24px"></i>
                                                                    </a>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </aside>
                                                </li>
                                            </ol>
                                        @endforeach
                                    @endif
                                </li>


                                <div class="comment_modal">
                                    <div class="modal fade" id="exampleModal{{ $comment->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ _('Trả lời') }} {{ $comment->user->name }}
                                                    </h5>

                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('comment') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="parent_id"
                                                            value="{{ $comment->id }}">
                                                        <input type="hidden" name="news_id"
                                                            value="{{ $news->id }}">

                                                        <label for="comment">Nội dung</label>
                                                        <textarea cols="30" rows="7" placeholder="Nội dung" name="comment"></textarea>
                                                        <button type="submit">Gửi Bình Luận</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ol>
                        @if (auth()->check())
                            <div class="comment-respond">
                                <h3 class="comment-reply-title">
                                    {{ _('Bình Luận') }}
                                </h3>

                                <form class="comment-form" method="POST" action="{{ route('comment') }}"
                                    id="comment-form">
                                    @csrf
                                    <input type="hidden" name="news_id" value="{{ $news->id }}">
                                    <p class="comment-form-comment">
                                        <label for="comment">Nội dung</label>
                                        <textarea name="comment" id="comment" cols="45" rows="5" maxlength="65525"></textarea>
                                        @error('comment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </p>

                                    <p class="form-submit mb-0">
                                        <input type="submit" id="submit" class="submit" value="Gửi Bình Luận">
                                    </p>
                                </form>
                            </div>
                        @else
                            <div class="comment-respond">
                                <h3 class="comment-reply-title mb-3">
                                    {{ _('Bình Luận') }}
                                </h3>
                                <a href="{{ route('login') }}">{{ _('Đăng nhập để bình luận') }}</a>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="single_navigation-prev">
                                @if ($previousNews !== null)
                                    <a href="{{ route('news.detail', $previousNews->slug) }}">
                                        <span>
                                            {{ _('Bài Trước') }}
                                        </span>
                                        {{ truncate($previousNews->title, 50) }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single_navigation-next text-left text-md-right">
                                @if ($nextNews !== null)
                                    <a href="{{ route('news.detail', $nextNews->slug) }}">
                                        <span>
                                            {{ _('Bài Tiếp') }}
                                        </span>
                                        {{ truncate($nextNews->title, 50) }}
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>

                    @if ($ads->view_page_ad_status === 1)
                        <div class="small_add_banner mb-5 pb-4">
                            <div class="small_add_banner_img">
                                <img src="{{ asset($ads->view_page_ad) }}" alt="adds">
                            </div>
                        </div>
                    @endif

                    <div class="clearfix"></div>

                    <div class="related-article">
                        <h4>
                            {{ _('Bạn có thể thích') }}
                        </h4>

                        <div class="article__entry-carousel-three">
                            @foreach ($relatedNews as $news)
                                <div class="item">
                                    <!-- Post Article -->
                                    <div class="article__entry">
                                        <div class="article__image">
                                            <a href="#">
                                                <img src="{{ asset($news->image) }}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="article__content">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <span class="text-primary">
                                                        {{ $news->author->name }}
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span>
                                                        {{ $news->created_at->format('d M, Y') }}
                                                    </span>
                                                </li>

                                            </ul>
                                            <h5>
                                                <a href="#">
                                                    {{ $news->title }}
                                                </a>
                                            </h5>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="sticky-top">
                    <aside class="wrapper__list__article ">
                        <!-- <h4 class="border_section">Sidebar</h4> -->
                        <div class="mb-4">
                            <div class="widget__form-search-bar  ">
                                <form class="row no-gutters" action="{{ route('news') }}" method="GET">
                                    <div class="col">
                                        <input class="form-control border-secondary border-right-0 rounded-0"
                                            placeholder="{{ _('Tìm kiếm') }}" name="search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit"
                                            class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="wrapper__list__article-small">
                            @forelse ($recentNews as $item)
                                @if ($loop->index <= 3)
                                    <div class="mb-3">
                                        <!-- Post Article -->
                                        <div class="card__post card__post-list">
                                            <div class="image-sm">
                                                <a href="{{ route('news.detail', $item->slug) }}">
                                                    <img src="{{ asset($item->image) }}" class="img-fluid"
                                                        alt="">
                                                </a>
                                            </div>


                                            <div class="card__post__body ">
                                                <div class="card__post__content">

                                                    <div class="card__post__author-info mb-2">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <span class="text-primary">
                                                                    {{ $item->author->name }}
                                                                </span>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <span class="text-dark text-capitalize">
                                                                    {{ $item->created_at->format('d M, Y') }}
                                                                </span>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="card__post__title">
                                                        <h6>
                                                            <a href="{{ route('news.detail', $item->slug) }}">
                                                                {{ $item->title }}
                                                            </a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Post Article -->
                                @if ($loop->index === 4)
                                    <div class="article__entry">
                                        <div class="article__image">
                                            <a href="#">
                                                <img src="{{ asset($item->image) }}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="article__content">
                                            <div class="article__category">
                                                <a href="#" class="text-white">
                                                    {{ $item->category->name }}
                                                </a>
                                            </div>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <span class="text-primary">
                                                        {{ $item->author->name }}
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span class="text-dark text-capitalize">
                                                        {{ $item->created_at->format('d M, Y') }}
                                                    </span>
                                                </li>

                                            </ul>
                                            <h5>
                                                <a href="{{ route('news.detail', $item->slug) }}">
                                                    {{ $item->title }}
                                                </a>
                                            </h5>
                                            <p>
                                                {!! Str::limit($item->content, 100) !!}
                                            </p>
                                            <a href="{{ route('news.detail', $item->slug) }}"
                                                class="btn btn-outline-primary mb-4 text-capitalize">
                                                {{ _('Xem thêm') }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="alert alert-warning">
                                    {{ _('Không có bài viết liên quan') }}
                                </div>
                            @endforelse
                        </div>
                    </aside>

                    <!-- social media -->
                    <aside class="wrapper__list__article">
                        <h4 class="border_section">
                            {{ _('Kết nối với chúng tôi') }}
                        </h4>
                        <!-- widget Social media -->
                        <div class="wrap__social__media">
                            <a href="#" target="_blank">
                                <div class="social__media__widget facebook">
                                    <span class="social__media__widget-icon">
                                        <i class="fa fa-facebook"></i>
                                    </span>
                                    <span class="social__media__widget-counter">
                                        Owen Bookstore
                                    </span>
                                    <span class="social__media__widget-name">
                                        {{ _('Theo dõi') }}
                                    </span>
                                </div>
                            </a>
                            <a href="#" target="_blank">
                                <div class="social__media__widget youtube">
                                    <span class="social__media__widget-icon">
                                        <i class="fa fa-youtube"></i>
                                    </span>
                                    <span class="social__media__widget-counter">
                                        Owen Bookstore
                                    </span>
                                    <span class="social__media__widget-name">
                                        {{ _('Theo dõi') }}
                                    </span>
                                </div>
                            </a>

                        </div>
                    </aside>
                    <!-- End social media -->

                    <aside class="wrapper__list__article">
                        <h4 class="border_section">Tags</h4>
                        <div class="blog-tags p-0">
                            <ul class="list-inline">
                                @forelse ($mostCommonTags as $tag)
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #{{ $tag->name }}
                                        </a>
                                    </li>
                                @empty
                                    <div class="alert alert-warning">
                                        {{ _('Không có thẻ nào') }}
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                    </aside>

                    <aside class="wrapper__list__article">
                        <h4 class="border_section">
                            {{ _('Đăng ký nhận tin') }}
                        </h4>
                        <!-- Form Subscribe -->
                        <div class="widget__form-subscribe bg__card-shadow">
                            <h6>
                                {{ _('Đăng ký nhận tin') }}
                            </h6>
                            <p><small>
                                    {{ _('Nhận thông báo về các bài viết mới nhất của chúng tôi') }}
                                </small></p>
                            <div class="input-group ">
                                <input type="text" class="form-control"
                                    placeholder="{{ _('Địa chỉ email của bạn') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        {{ _('Đăng ký') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </aside>

                    @if ($ads->side_bar_ad_status === 1)
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">Quảng Cáo</h4>
                            <a href="{{ $ads->side_bar_ad_url }}">
                                <figure>
                                    <img src="{{ asset($ads->side_bar_ad) }}" alt="" class="img-fluid">
                                </figure>
                            </a>
                        </aside>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
