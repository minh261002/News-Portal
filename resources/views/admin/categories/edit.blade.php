@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Danh mục bài viết</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Chỉnh sửa thông tin</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="">Ngôn ngữ</label>
                        <select name="language" id="language-select" class="form-control select2">
                            <option value="">Chọn ngôn ngữ</option>
                            @foreach ($languages as $lang)
                                <option {{ $lang->lang === $category->language ? 'selected' : '' }}
                                    value="{{ $lang->lang }}">{{ $lang->name }}</option>
                            @endforeach
                        </select>
                        @error('language')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input name="name" value="{{ $category->name }}" type="text" class="form-control"
                            id="name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Tuỳ chọn hiển thị </label>
                        <select name="show_at_nav" id="" class="form-control">
                            <option {{ $category->show_at_nav === 0 ? 'selected' : '' }} value="0">
                                Hiển thị</option>
                            <option {{ $category->show_at_nav === 1 ? 'selected' : '' }} value="1">
                                Không hiển thị</option>
                        </select>
                        @error('defalut')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <select name="status" id="" class="form-control">
                            <option {{ $category->status === 1 ? 'selected' : '' }} value="1">
                                Kích hoạt</option>
                            <option {{ $category->status === 0 ? 'selected' : '' }} value="0">
                                Không kích hoạt</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                </form>
            </div>
        </div>
    </section>
@endsection
