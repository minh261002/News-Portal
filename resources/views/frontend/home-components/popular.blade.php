<section>
    <!-- Popular news  header-->
    <div class="popular__news-header">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ">
                    <div class="card__post-carousel">
                        @foreach ($heroSlider as $slider)
                            @if ($loop->index <= 3)
                                <div class="item">
                                    <!-- Post Article -->
                                    <div class="card__post">
                                        <div class="card__post__body">
                                            <a href="{{ route('news.detail', $slider->slug) }}">
                                                <img src="{{ asset($slider->image) }}" class="img-fluid" alt="">
                                            </a>
                                            <div class="card__post__content bg__post-cover">
                                                <div class="card__post__category">
                                                    {{ $slider->category->name }}
                                                </div>
                                                <div class="card__post__title">
                                                    <h2>
                                                        <a href="#">
                                                            {{ truncate($slider->title, 50) }}
                                                        </a>
                                                    </h2>
                                                </div>
                                                <div class="card__post__author-info">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="#">
                                                                {{ $slider->author->name }}
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                {{ $slider->created_at->format('M d, Y') }}
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
                </div>
                <div class="col-md-4">
                    <div class="popular__news-right">
                        <!-- Post Article -->
                        @foreach ($heroSlider as $slider)
                            @if ($loop->index > 3)
                                <div class="card__post">
                                    <div class="card__post__body card__post__transition">
                                        <a href="{{ route('news.detail', $slider->slug) }}">
                                            <img src="{{ asset($slider->image) }}" class="img-fluid" alt="">
                                        </a>
                                        <div class="card__post__content bg__post-cover">
                                            <div class="card__post__category">
                                                {{ $slider->category->name }}
                                            </div>
                                            <div class="card__post__title">
                                                <h5>
                                                    <a href="{{ route('news.detail', $slider->slug) }}">
                                                        {{ truncate($slider->title, 50) }}
                                                    </a>
                                                </h5>
                                            </div>
                                            <div class="card__post__author-info">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('news.detail', $slider->slug) }}">
                                                            {{ $slider->author->name }}
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span>
                                                            {{ $slider->created_at->format('M d, Y') }}
                                                        </span>
                                                    </li>
                                                </ul>
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
    </div>
</section>
