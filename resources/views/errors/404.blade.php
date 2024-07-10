@extends('frontend.layouts.master')

@section('content')
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-sm-10 col-md-8 col-lg-7 m-auto text-center">
                    <div class="error_text">
                        <div class="img">
                            <img src="{{ asset('frontend/images/error.jpg') }}" alt="error">
                        </div>
                        <h4>
                            {{ _('404') }}
                        </h4>
                        <p>
                            {{ _('Xin lỗi, trang bạn đang tìm kiếm không tồn tại') }}
                        </p>
                        <a class="btn btn-primary" href="/">
                            {{ _('Trở về trang chủ') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
