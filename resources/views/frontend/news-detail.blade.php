@extends('frontend.layouts.master')

@section('meta_title', $news->meta_title)

@section('meta_description', $news->meta_description)

@section('tags', $news->tags->pluck('name')->implode(','))

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
                                        <a class="btn btn-social-o facebook" href="#">
                                            <i class="fa fa-facebook-f"></i>
                                            <span>facebook</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o twitter" href="#">
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
                            <li class="list-inline-item">
                                <a href="#">
                                    #property
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    #sea
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    #programming
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    #sea
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    #property
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- end tags-->

                    <!-- authors-->
                    <!-- Profile author -->
                    <div class="wrap__profile">
                        <div class="wrap__profile-author">
                            <figure>
                                <img src="images/news1.jpg" alt="" class="img-fluid rounded-circle">
                            </figure>
                            <div class="wrap__profile-author-detail">
                                <div class="wrap__profile-author-detail-name">author</div>
                                <h4>jhon doe</h4>
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
                        <h3 class="comments-title">2 Comments:</h3>

                        <ol class="comment-list">
                            <li class="comment">
                                <aside class="comment-body">
                                    <div class="comment-meta">
                                        <div class="comment-author vcard">
                                            <img src="images/news2.jpg" class="avatar" alt="image">
                                            <b class="fn">Sinmun</b>
                                            <span class="says">says:</span>
                                        </div>

                                        <div class="comment-metadata">
                                            <a href="#">
                                                <span>April 24, 2019 at 10:59 am</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="comment-content">
                                        <p>Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s,
                                            when an unknown
                                            printer took a galley of type and scrambled it to make a type specimen book.
                                        </p>
                                    </div>

                                    <div class="reply">
                                        <a href="#" class="comment-reply-link" data-toggle="modal"
                                            data-target="#exampleModal">Reply</a>
                                        <span>
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    </div>
                                </aside>

                                <ol class="children">
                                    <li class="comment">
                                        <aside class="comment-body">
                                            <div class="comment-meta">
                                                <div class="comment-author vcard">
                                                    <img src="images/news3.jpg" class="avatar" alt="image">
                                                    <b class="fn">Sinmun</b>
                                                    <span class="says">says:</span>
                                                </div>

                                                <div class="comment-metadata">
                                                    <a href="#">
                                                        <span>April 24, 2019 at 10:59 am</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="comment-content">
                                                <p>Lorem Ipsum has been the industry’s standard dummy text ever since
                                                    the 1500s, when an
                                                    unknown printer took a galley of type and scrambled it to make a
                                                    type specimen book.</p>
                                            </div>

                                            <div class="reply">
                                                <a href="#" class="comment-reply-link" data-toggle="modal"
                                                    data-target="#exampleModal">Reply</a>
                                                <span>
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </div>
                                        </aside>
                                    </li>
                                </ol>
                            </li>

                            <li class="comment">
                                <aside class="comment-body">
                                    <div class="comment-meta">
                                        <div class="comment-author vcard">
                                            <img src="images/news4.jpg" class="avatar" alt="image">
                                            <b class="fn">Sinmun</b>
                                            <span class="says">says:</span>
                                        </div>

                                        <div class="comment-metadata">
                                            <a href="#">
                                                <span>April 24, 2019 at 10:59 am</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="comment-content">
                                        <p>Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s,
                                            when an unknown
                                            printer took a galley of type and scrambled it to make a type specimen book.
                                        </p>
                                    </div>

                                    <div class="reply">
                                        <a href="#" class="comment-reply-link" data-toggle="modal"
                                            data-target="#exampleModal">Reply</a>
                                        <span>
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    </div>
                                </aside>
                            </li>
                        </ol>

                        <div class="comment-respond">
                            <h3 class="comment-reply-title">Leave a Reply</h3>

                            <form class="comment-form">
                                <p class="comment-notes">
                                    <span id="email-notes">Your email address will not be published.</span>
                                    Required fields are marked
                                    <span class="required">*</span>
                                </p>
                                <p class="comment-form-comment">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" id="comment" cols="45" rows="5" maxlength="65525" required="required"></textarea>
                                </p>
                                <p class="comment-form-author">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" id="author" name="name" required="required">
                                </p>
                                <p class="comment-form-email">
                                    <label for="email">Email <span class="required">*</span></label>
                                    <input type="email" id="email" name="email" required="required">
                                </p>
                                <p class="comment-form-url">
                                    <label for="url">Website</label>
                                    <input type="url" id="url" name="url">
                                </p>
                                <p class="comment-form-cookies-consent">
                                    <input type="checkbox" value="yes" name="wp-comment-cookies-consent"
                                        id="wp-comment-cookies-consent">
                                    <label for="wp-comment-cookies-consent">Save my name, email, and website in this
                                        browser for the next
                                        span I comment.</label>
                                </p>
                                <p class="form-submit mb-0">
                                    <input type="submit" name="submit" id="submit" class="submit"
                                        value="Post Comment">
                                </p>
                            </form>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="comment_modal">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Write Your Comment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#">
                                            <textarea cols="30" rows="7" placeholder="Type. . ."></textarea>
                                            <button type="submit">submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end comment -->



                    <div class="row">
                        <div class="col-md-6">
                            <div class="single_navigation-prev">
                                <a href="#">
                                    <span>previous post</span>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, similique.
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single_navigation-next text-left text-md-right">
                                <a href="#">
                                    <span>next post</span>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis, nesciunt.
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="small_add_banner mb-5 pb-4">
                        <div class="small_add_banner_img">
                            <img src="images/placeholder_large.jpg" alt="adds">
                        </div>
                    </div>


                    <div class="clearfix"></div>

                    <div class="related-article">
                        <h4>
                            you may also like
                        </h4>

                        <div class="article__entry-carousel-three">
                            <div class="item">
                                <!-- Post Article -->
                                <div class="article__entry">
                                    <div class="article__image">
                                        <a href="#">
                                            <img src="images/newsimage5.png" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="article__content">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span class="text-primary">
                                                    by david hall
                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <span>
                                                    descember 09, 2016
                                                </span>
                                            </li>

                                        </ul>
                                        <h5>
                                            <a href="#">
                                                Maecenas accumsan tortor ut velit pharetra mollis.
                                            </a>
                                        </h5>

                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <!-- Post Article -->
                                <div class="article__entry">
                                    <div class="article__image">
                                        <a href="#">
                                            <img src="images/newsimage6.png" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="article__content">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span class="text-primary">
                                                    by david hall
                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <span>
                                                    descember 09, 2016
                                                </span>
                                            </li>

                                        </ul>
                                        <h5>
                                            <a href="#">
                                                Maecenas accumsan tortor ut velit pharetra mollis.
                                            </a>
                                        </h5>

                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <!-- Post Article -->
                                <div class="article__entry">
                                    <div class="article__image">
                                        <a href="#">
                                            <img src="images/newsimage7.png" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="article__content">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span class="text-primary">
                                                    by david hall
                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <span>
                                                    descember 09, 2016
                                                </span>
                                            </li>

                                        </ul>
                                        <h5>
                                            <a href="#">
                                                Maecenas accumsan tortor ut velit pharetra mollis.
                                            </a>
                                        </h5>

                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <!-- Post Article -->
                                <div class="article__entry">
                                    <div class="article__image">
                                        <a href="#">
                                            <img src="images/newsimage8.png" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="article__content">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span class="text-primary">
                                                    by david hall
                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <span>
                                                    descember 09, 2016
                                                </span>
                                            </li>

                                        </ul>
                                        <h5>
                                            <a href="#">
                                                Maecenas accumsan tortor ut velit pharetra mollis.
                                            </a>
                                        </h5>

                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <!-- Post Article -->
                                <div class="article__entry">
                                    <div class="article__image">
                                        <a href="#">
                                            <img src="images/newsimage9.png" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="article__content">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span class="text-primary">
                                                    by david hall
                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <span>
                                                    descember 09, 2016
                                                </span>
                                            </li>

                                        </ul>
                                        <h5>
                                            <a href="#">
                                                Maecenas accumsan tortor ut velit pharetra mollis.
                                            </a>
                                        </h5>

                                    </div>
                                </div>
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
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <input class="form-control border-secondary border-right-0 rounded-0"
                                                value="" placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button
                                                class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
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
                                                    <img src="{{ asset($item->image) }}" alt=""
                                                        class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="article__content">
                                                <div class="article__category">
                                                    <a href="#">
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
                                                    <a href="#">
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
                            <h4 class="border_section">stay conected</h4>
                            <!-- widget Social media -->
                            <div class="wrap__social__media">
                                <a href="#" target="_blank">
                                    <div class="social__media__widget facebook">
                                        <span class="social__media__widget-icon">
                                            <i class="fa fa-facebook"></i>
                                        </span>
                                        <span class="social__media__widget-counter">
                                            19,243 fans
                                        </span>
                                        <span class="social__media__widget-name">
                                            like
                                        </span>
                                    </div>
                                </a>
                                <a href="#" target="_blank">
                                    <div class="social__media__widget twitter">
                                        <span class="social__media__widget-icon">
                                            <i class="fa fa-twitter"></i>
                                        </span>
                                        <span class="social__media__widget-counter">
                                            2.076 followers
                                        </span>
                                        <span class="social__media__widget-name">
                                            follow
                                        </span>
                                    </div>
                                </a>
                                <a href="#" target="_blank">
                                    <div class="social__media__widget youtube">
                                        <span class="social__media__widget-icon">
                                            <i class="fa fa-youtube"></i>
                                        </span>
                                        <span class="social__media__widget-counter">
                                            15,200 followers
                                        </span>
                                        <span class="social__media__widget-name">
                                            subscribe
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
                            <h4 class="border_section">newsletter</h4>
                            <!-- Form Subscribe -->
                            <div class="widget__form-subscribe bg__card-shadow">
                                <h6>
                                    The most important world news and events of the day.
                                </h6>
                                <p><small>Get magzrenvi daily newsletter on your inbox.</small></p>
                                <div class="input-group ">
                                    <input type="text" class="form-control" placeholder="Your email address">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">sign up</button>
                                    </div>
                                </div>
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">Advertise</h4>
                            <a href="#">
                                <figure>
                                    <img src="images/news6.jpg" alt="" class="img-fluid">
                                </figure>
                            </a>
                        </aside>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
