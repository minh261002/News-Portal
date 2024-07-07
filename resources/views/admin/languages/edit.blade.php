@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Ngôn ngữ') }}</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Chỉnh sửa thông tin') }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.languages.update', $language->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label for="lang">{{ __('Ngôn ngữ') }}</label>
                            <select name="lang" class="form-control select2" id="language">
                                <option value="">{{ __('Chọn ngôn ngữ') }}</option>
                                @foreach (config('language') as $key => $lang)
                                    <option value="{{ $key }}" {{ $language->lang == $key ? 'selected' : '' }}>
                                        {{ $lang['name'] }}</option>
                                @endforeach
                            </select>
                            @error('lang')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="name">{{ __('Tên ngôn ngữ') }}</label>
                            <input type="text" name="name" class="form-control" id="name" readonly
                                value="{{ $language->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" class="form-control" id="slug" readonly
                                value="{{ $language->slug }}">
                        </div>

                        <div class="form-group mb-4">
                            <label for="default">Mặc định</label>
                            <select name="default" class="form-control">
                                <option value="0" {{ $language->default == 0 ? 'selected' : '' }}>Không</option>
                                <option value="1" {{ $language->default == 1 ? 'selected' : '' }}>Có</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="status">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="0" {{ $language->status == 0 ? 'selected' : '' }}>Không kích hoạt
                                </option>
                                <option value="1" {{ $language->status == 1 ? 'selected' : '' }}>Kích hoạt</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Lưu Thay Đổi') }}</button>
                        <a href="{{ route('admin.languages.index') }}" class="btn btn-secondary">{{ __('Quay lại') }}</a>
                    </form>
                </div>
            </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#language').on('change', function() {
                $('#slug').val($(this).val());
                $('#name').val($(this).find('option:selected').text());
            });
        });
    </script>
@endpush
