@extends('frontend.layouts.master')

@section('content')
    <!-- Tranding news  carousel-->
    @include('frontend.home-components.tranding')
    <!-- End Tranding news carousel -->

    <!-- Popular news -->
    @include('frontend.home-components.popular')
    <!-- End Popular news -->

    @if ($ads->home_top_bar_ad_status && $ads->home_top_bar_ad)
        <div class="large_add_banner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="large_add_banner_img">
                            <img src="{{ asset($ads->home_top_bar_ad) }}" alt="adds">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Popular news category -->
    @include('frontend.home-components.category')
    <!-- End Popular news category -->
@endsection
