@extends('frontend.layouts.master')


@section('title', 'Quên Mật Khẩu')
@section('content')
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mx-auto" style="max-width: 400px;">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Đặt Lại Mật Khẩu</h4>
                            <form action="{{ route('password.store') }}" style="display:flex; gap: 10px ;flex-direction:column"
                                method="POST">
                                @csrf
                                @session('status')
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @enderror


                                @session('error')
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @enderror

                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" type="text" name="email" value="{{ request()->email }}" readonly>
                                    <span style="color: red">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Mật Khẩu" type="password" name="password">
                                    <span style="color: red; text-transform: capitalize">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Nhập Lại Mật Khẩu" type="password" name="password_confirmation">
                                    <span style="color: red; text-transform: capitalize">
                                        @error('password_confirmation')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                       Đặt Lại Mật Khẩu
                                    </button>
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
