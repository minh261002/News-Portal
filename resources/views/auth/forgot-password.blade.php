@extends('frontend.layouts.master')


@section('title', 'Quên Mật Khẩu')
@section('content')
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mx-auto" style="max-width: 400px;">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Quên Mật Khẩu</h4>
                            <form action="{{ route('password.email') }}" style="display:flex; gap: 10px ;flex-direction:column"
                                method="POST">
                                @csrf
                                @session('status')
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" type="text" name="email">
                                    <span style="color: red">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Xác Nhận Email
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
