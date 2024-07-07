@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Ngôn ngữ') }}</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Thêm mới ngôn ngữ') }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.languages.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="lang">{{ __('Ngôn ngữ') }}</label>
                            <select name="lang" class="form-control select2" id="language">
                                <option value="">{{ __('Chọn ngôn ngữ') }}</option>
                                @foreach (config('language') as $key => $lang)
                                    <option value="{{ $key }}">{{ $lang['name'] }}</option>
                                @endforeach
                            </select>
                            @error('lang')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="name">{{ __('Tên ngôn ngữ') }}</label>
                            <input type="text" name="name" class="form-control" id="name" readonly>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" class="form-control" id="slug" readonly>
                        </div>

                        <div class="form-group mb-4">
                            <label for="default">Mặc định</label>
                            <select name="default" class="form-control">
                                <option value="0">Không</option>
                                <option value="1">Có</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="status">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="0">Không kích hoạt</option>
                                <option value="1">Kích hoạt</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Thêm mới') }}</button>
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
