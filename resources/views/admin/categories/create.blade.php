@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Danh mục bài viết</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Thêm danh mục mới</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Ngôn ngữ</label>
                        <select name="language" id="language-select" class="form-control select2">
                            <option value="">Chọn ngôn ngữ</option>
                            @foreach ($languages as $lang)
                                <option value="{{ $lang->lang }}">{{ $lang->name }}</option>
                            @endforeach
                        </select>
                        @error('language')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input name="name" type="text" class="form-control" id="name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Hiển thị trên menu </label>
                        <select name="show_at_nav" id="" class="form-control">
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                        </select>
                        @error('defalut')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trạng Thái</label>
                        <select name="status" id="" class="form-control">
                            <option value="0">Không kích hoạt</option>
                            <option value="1">Kích hoạt</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Hủy</a>
                </form>
            </div>
        </div>
    </section>
@endsection
