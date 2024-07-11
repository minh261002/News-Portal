@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Uỷ Quyền Người Dùng') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Chỉnh sửa thông tin') }}</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.role_user.update', $admin->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">{{ __('Họ và tên') }}</label>
                        <input type="text" class="form-control" name="name" value="{{ $admin->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('Email') }}</label>
                        <input type="text" class="form-control" name="email" value="{{ $admin->email }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('Mật Khẩu') }}</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('Nhập Lại Mật Khẩu') }}</label>
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
                                <option {{ $role->name === $admin->getRoleNames()->first() ? 'selected' : '' }}
                                    value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>

                        @error('role')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Lưu Thay Đổi') }}</button>
                    <a href="{{ route('admin.role_user.index') }}" class="btn btn-danger">{{ __('Quay Lại') }}</a>
                </form>
            </div>
        </div>
    </section>
@endsection
