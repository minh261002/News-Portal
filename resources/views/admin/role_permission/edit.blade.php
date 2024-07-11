@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Phân Quyền Người Dùng') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Cập Nhật Thông Tin') }}</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">{{ __('Tên') }}</label>
                        <input type="text" class="form-control" name="role" value="{{ $role->name }}">
                        @error('role')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr>
                    @foreach ($premissions as $groupName => $premission)
                        <div class="form-group">
                            <h6 class="text-primary">{{ $groupName }}</h6>
                            <div class="row">
                                @foreach ($premission as $item)
                                    <div class="col-md-2">
                                        <label class="custom-switch mt-2">
                                            <input {{ in_array($item->name, $rolesPermissions) ? 'checked' : '' }}
                                                value="{{ $item->name }}" type="checkbox" name="permissions[]"
                                                class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description text-primary">{{ $item->name }}</span>
                                        </label>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                    @endforeach

                    <button type="submit" class="btn btn-primary">{{ __('Lưu Thay Đổi') }}</button>
                    <a href="{{ route('admin.role.index') }}" class="btn btn-danger">{{ __('Quay Lại') }}</a>
                </form>
            </div>
        </div>
    </section>
@endsection
