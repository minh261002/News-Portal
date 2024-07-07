@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Thông Tin Cá Nhân</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Thông Tin Cá Nhân</h4>
                        </div>

                        <form class="card-body" method="POST" action="{{ route('admin.profile.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Chọn Ảnh</label>
                                    <input type="file" name="image" id="image-upload" />
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="name">Họ Và Tên</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ Auth::guard('admin')->user()->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ Auth::guard('admin')->user()->email }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <input type="submit" class="btn btn-primary" value="Cập Nhật Thông Tin">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Đổi Mật Khẩu</h4>
                        </div>

                        <form class="card-body" method="POST" action="{{ route('admin.profile.password') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label for="current_password">Mật Khẩu Hiện Tại</label>
                                <input type="password" name="current_password" id="current_password" class="form-control">
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password">Mật Khẩu Mới</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password_confirmation">Nhập Lại Mật Khẩu Mới</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <input type="submit" class="btn btn-primary" value="Đổi Mật Khẩu">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.image-preview').css({
                "background-image": "url('{{ Auth::guard('admin')->user()->image ? asset(Auth::guard('admin')->user()->image) : asset('admin/assets/img/avatar/avatar-1.png') }}')",
                "background-size": "cover",
                "background-position": "center center"
            });
        });
    </script>
@endpush
