<section class="pt-0 mt-5">
    <div class="popular__section-news">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="wrapper__list__article">
                        <h4 class="border_section">
                            {{ _('Bài viết mới') }}
                        </h4>
                    </div>
                    <div class="row ">
                        @foreach ($recentNews as $news)
                            @if ($loop->index <= 1)
                                <div class="col-sm-12 col-md-6 mb-4">
                                    <!-- Post Article -->
                                    <div class="card__post ">
                                        <div class="card__post__body card__post__transition">
                                            <a href="{{ route('news.detail', $news->slug) }}">
                                                <img src="{{ asset($news->image) }}" class="img-fluid" alt="">
                                            </a>
                                            <div class="card__post__content bg__post-cover">
                                                <div class="card__post__category">
                                                    {{ $news->category->name }}
                                                </div>
                                                <div class="card__post__title">
                                                    <h5>
                                                        <a href="{{ route('news.detail', $news->slug) }}">
                                                            {{ $news->title }}
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div class="card__post__author-info">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('news.detail', $news->slug) }}">
                                                                {{ $news->author->name }}
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                {{ $news->created_at->format('M d, Y') }}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="row ">
                        <div class="col-sm-12 col-md-6">
                            <div class="wrapp__list__article-responsive">
                                @foreach ($recentNews as $news)
                                    @if ($loop->index > 1 && $loop->index <= 3)
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
                                                                        {{ $news->created_at->format('d M, Y') }}
                                                                    </span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ route('news.detail', $news->slug) }}">
                                                                    {{ $news->title }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 ">
                            <div class="wrapp__list__article-responsive">
                                @foreach ($recentNews as $news)
                                    @if ($loop->index > 1 && $loop->index > 3)
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
                                                                        {{ $news->created_at->format('d M, Y') }}
                                                                    </span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ route('news.detail', $news->slug) }}">
                                                                    {{ $news->title }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 col-lg-4">
                    <aside class="wrapper__list__article">
                        <h4 class="border_section">Phổ Biến</h4>
                        <div class="wrapper__list-number">

                            <!-- List Article -->
                            @foreach ($popularNews as $news)
                                <div class="card__post__list">
                                    <div class="list-number">
                                        <span>
                                            {{ $loop->iteration }}
                                        </span>
                                    </div>
                                    <a href="#" class="category">
                                        {{ $news->category->name }}
                                    </a>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <h5>
                                                <a href="{{ route('news.detail', $news->slug) }}">
                                                    {{ truncate($news->title, 50) }}
                                                </a>
                                            </h5>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <!-- Post news carousel -->
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">
                        {{ $homeSection1->first()->category->name ?? 'Bài viết' }}
                    </h4>
                </aside>
            </div>
            <div class="col-md-12">

                <div class="article__entry-carousel">
                    @forelse($homeSection1 as $news)
                        <div class="item">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="{{ route('news.detail', $news->slug) }}">
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
                                        <a href="{{ route('news.detail', $news->slug) }}">
                                            {{ truncate($news->title, 50) }}
                                        </a>
                                    </h5>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning">
                            {{ _('Không có bài viết nào') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">
                        {{ $homeSection2->first()->category->name ?? 'Bài viết' }}
                    </h4>
                </aside>
            </div>
            <div class="col-md-12">

                <div class="article__entry-carousel">
                    @forelse($homeSection2 as $news)
                        <div class="item">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="{{ route('news.detail', $news->slug) }}">
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
                                        <a href="{{ route('news.detail', $news->slug) }}">
                                            {{ truncate($news->title, 50) }}
                                        </a>
                                    </h5>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning">
                            {{ _('Không có bài viết nào') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- End Popular news category -->


    <!-- Popular news category -->
    <div class="mt-4">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-8">
                    <aside class="wrapper__list__article mb-0">
                        <h4 class="border_section">
                            {{ $homeSection3->first()->category->name ?? 'Bài viết' }}
                        </h4>
                        <div class="row">
                            @forelse ($homeSection3 as $news)
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <!-- Post Article -->
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="{{ route('news.detail', $news->slug) }}">
                                                    <img src="{{ asset($news->image) }}" alt=""
                                                        class="img-fluid">
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
                                                    <a href="{{ route('news.detail', $news->slug) }}">
                                                        {{ truncate($news->title, 50) }}
                                                    </a>
                                                </h5>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-warning">
                                    {{ _('Không có bài viết nào') }}
                                </div>
                            @endforelse

                        </div>
                    </aside>

                    @if ($ads->home_middle_ad_status === 1)
                        <div class="small_add_banner">
                            <div class="small_add_banner_img">
                                <img src="{{ asset($ads->home_middle_ad) }}" alt="adds">
                            </div>
                        </div>
                    @endif

                    <aside class="wrapper__list__article mt-5">
                        <h4 class="border_section">
                            {{ $homeSection4->first()->category->name ?? 'Bài viết' }}
                        </h4>

                        <div class="wrapp__list__article-responsive">
                            @forelse($homeSection4 as $news)
                                <div class="card__post card__post-list card__post__transition mt-30">
                                    <div class="row ">
                                        <div class="col-md-5">
                                            <div class="card__post__transition">
                                                <a href="{{ route('news.detail', $news->slug) }}">
                                                    <img src="{{ asset($news->image) }}" class="img-fluid w-100"
                                                        alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-7 my-auto pl-0">
                                            <div class="card__post__body ">
                                                <div class="card__post__content  ">
                                                    <div class="card__post__category ">
                                                        {{ $news->category->name }}
                                                    </div>
                                                    <div class="card__post__author-info mb-2">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <span class="text-primary">
                                                                    {{ $news->author->name }}
                                                                </span>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <span class="text-dark text-capitalize">
                                                                    {{ $news->created_at->format('d M, Y') }}
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="card__post__title">
                                                        <h5>
                                                            <a href="{{ route('news.detail', $news->slug) }}">
                                                                {{ truncate($news->title, 50) }}
                                                            </a>
                                                        </h5>
                                                        <p class="d-none d-lg-block d-xl-block mb-0">
                                                            {!! truncate($news->content, 100) !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-warning">
                                    {{ _('Không có bài viết nào') }}
                                </div>
                            @endforelse
                        </div>
                    </aside>
                </div>

                <div class="col-md-4">
                    <div class="sticky-top">
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">
                                {{ $homeSection5->first()->category->name ?? 'Bài viết' }}
                            </h4>
                            <div class="wrapper__list__article-small">
                                @forelse ($homeSection5 as $news)
                                    <!-- Post Article -->
                                    @if ($loop->first)
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="{{ route('news.detail', $news->slug) }}">
                                                    <img src="{{ asset($news->image) }}" alt=""
                                                        class="img-fluid">
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
                                                            {{ $news->created_at->format('d M, Y') }}
                                                        </span>
                                                    </li>

                                                </ul>
                                                <h5>
                                                    <a href="#">
                                                        {{ truncate($news->title, 50) }}
                                                    </a>
                                                </h5>
                                                <p>
                                                    {!! truncate($news->content, 100) !!}
                                                </p>
                                                <a href="#"
                                                    class="btn btn-outline-primary mb-4 text-capitalize">
                                                    {{ _('Xem chi tiết') }}
                                                </a>
                                            </div>
                                        </div>
                                    @else
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
                                                                        {{ $news->created_at->format('d M, Y') }}
                                                                    </span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ route('news.detail', $news->slug) }}">
                                                                    {{ truncate($news->title, 50) }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="alert alert-warning">
                                        {{ _('Không có bài viết nào') }}
                                    </div>
                                @endforelse
                            </div>
                        </aside>

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

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">tags</h4>
                            <div class="blog-tags p-0">
                                <ul class="list-inline">
                                    @foreach ($tags as $tag)
                                        <li class="list-inline-item">
                                            <a href="#">
                                                #{{ $tag->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>

                        @if ($ads->side_bar_ad_status === 1)
                            <aside class="wrapper__list__article">
                                <h4 class="border_section">
                                    {{ _('Quảng Cáo') }}
                                </h4>
                                <a href="{{ $ads->side_bar_ad_url }}">
                                    <figure>
                                        <img src="{{ asset($ads->side_bar_ad) }}" alt="" class="img-fluid">
                                    </figure>
                                </a>
                            </aside>
                        @endif

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">
                                {{ _('Đăng ký nhận tin') }}
                            </h4>
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
                                    <input type="email" class="form-control"
                                        placeholder="{{ _('Địa chỉ email') }}" name="email" id="newsletter-email">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            {{ _('Đăng ký') }}
                                        </button>
                                    </div>

                                    <span class="text-danger" id="emailErr"></span>
                                </div>
                            </form>
                        </aside>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>
