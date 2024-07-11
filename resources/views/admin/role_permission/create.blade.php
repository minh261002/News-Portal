@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Phân Quyền Người Dùng</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Thêm Mới</h4>
                </div>

                <div class="card-body">
                    <div class="card-body">
                        <form action="{{ route('admin.role.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="">{{ __('Tên') }}</label>
                                <input type="text" class="form-control" name="role">
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
                                                    <input value="{{ $item->name }}" type="checkbox" name="permissions[]"
                                                        class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span
                                                        class="custom-switch-description text-primary">{{ $item->name }}</span>
                                                </label>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                            @endforeach

                            <button type="submit" class="btn btn-primary">{{ __('Thêm Mới') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
