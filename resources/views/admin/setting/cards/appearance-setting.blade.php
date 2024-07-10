<div class="card border border-primary">
    <div class="card-body">
        <form action="{{ route('admin.appearance-setting.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>{{ __('Chọn màu của website') }}</label>
                <div class="input-group colorpickerinput">
                    <input value="{{ $setting['site_color'] }}" name="site_color" type="text" class="form-control">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-fill-drip"></i>
                        </div>
                    </div>
                    @error('site_color')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Lưu Thay Đổi') }}</button>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(".colorpickerinput").colorpicker({
            format: 'hex',
            component: '.input-group-append',

        });
    </script>
@endpush
