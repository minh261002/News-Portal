@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Uỷ quyền người dùng') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Thêm tài khoản') }}</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.role_user.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="">{{ __('Họ và tên') }}</label>
                        <input type="text" class="form-control" name="name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('Email') }}</label>
                        <input type="text" class="form-control" name="email">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('Mật khẩu') }}</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('Nhập lại mật khẩu') }}</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        @error('password_confirmation')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('Quyền') }}</label>

                        <select name="role" id="" class="select2 form-control">
                            <option value="">{{ __('--Chọn--') }}</option>

                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>

                        @error('role')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-primary">{{ __('Thêm tài khoản') }}</button>
                    <a href="{{ route('admin.role_user.index') }}" class="btn btn-danger">{{ __('Hủy') }}</a>

                </form>
            </div>
        </div>
    </section>
@endsection
