@extends('frontend.layouts.master')


@section('title', 'Đăng nhập')
@section('content')
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mx-auto" style="max-width: 400px;">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Đăng Nhập</h4>
                            <form action="{{ route('login') }}" style="display:flex; gap: 10px ;flex-direction:column"
                                method="POST">
                                @csrf
                                <a href="#" class="btn btn-facebook btn-block mb-2 text-white"> <i
                                        class="fa fa-facebook"></i> &nbsp;
                                    Tiếp tục với Facebook
                                </a>
                                <a href="#" class="btn btn-block mb-4"
                                    style="
                                    background-color: white;
                                    color: #ea4336;
                                    border-color: #ea4336;
                                    hover: white;
                                    ">
                                    <i class="fa fa-google"></i>
                                    &nbsp;
                                    Tiếp tục với Google
                                </a>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" type="text" name="email">
                                    <span style="color: red">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mật Khẩu" type="password" name="password">
                                    <span style="color: red; text-style: uppercase">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <a href="#" class="float-right">Quên mật khẩu ?</a>
                                    <label class="float-left custom-control custom-checkbox"> <input type="checkbox"
                                            class="custom-control-input" checked="" name="remember">
                                        <span class="custom-control-label"> Lưu thông tin </span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"> Đăng nhập </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <p class="text-center mt-4 mb-0">Bạn chưa có tài khoản ? <a href="{{ route('register') }}">Đăng Ký</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
