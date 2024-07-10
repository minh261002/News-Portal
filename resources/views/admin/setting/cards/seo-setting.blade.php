<div class="card border border-primary">
    <div class="card-body">
        <form action="{{ route('admin.seo-setting.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="">{{ __('Tiêu đề SEO') }}</label>
                <input type="text" name="site_seo_title" value="{{ $setting['site_seo_title'] }}" class="form-control"
                    value="">
                @error('site_seo_title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">

                <label for="">{{ __('Mô tả Seo') }}</label>
                <textarea name="site_seo_description" class="form-control" style="height: 300px" id="" cols="30"
                    rows="10">{{ $setting['site_seo_description'] }}</textarea>
                @error('site_seo_description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">

                <label for="">{{ __('Từ Khoá') }}</label>
                <input name="site_seo_keywords" type="text" class="form-control inputtags"
                    value="{{ $setting['site_seo_keywords'] }}">
                @error('site_seo_keywords')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Lưu Thay Đổi') }}</button>
        </form>
    </div>
</div>
