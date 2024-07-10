<div class="card border border-primary">
    <div class="card-body">
        <form action="{{ route('admin.general-setting.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="">{{ __('Tên trang web') }}</label>
                <input type="text" name="site_name" class="form-control" value="{{ $setting['site_name'] }}">
                @error('site_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <img src="{{ asset($setting['site_logo']) }}" alt="" width="150px"> <br>
                <label for="">{{ __('Logo') }}</label>
                <input type="file" name="site_logo" class="form-control">
                @error('site_logo')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <img src="{{ asset($setting['site_favicon']) }}" alt="" width="150px"> <br>
                <label for="">{{ __('Favicon') }}</label>
                <input type="file" name="site_favicon" class="form-control">
                @error('site_favicon')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Lưu Thay Đổi') }}</button>
        </form>
    </div>
</div>
