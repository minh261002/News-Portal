@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Bài viết</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Chỉnh sửa thông tin</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.new.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Ngôn ngữ</label>
                        <select name="language" id="language-select" class="form-control select2">
                            <option value="">Chọn ngôn ngữ</option>
                            @foreach ($languages as $lang)
                                <option value="{{ $lang->lang }}" {{ $news->language == $lang->lang ? 'selected' : '' }}>
                                    {{ $lang->name }}</option>
                            @endforeach
                        </select>
                        @error('language')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="hidden" name="author_id" value="{{$news->author_id }}" />
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select name="category" id="category" class="form-control select2">
                            <option value="">Chọn danh mục</option>
                            @foreach ($categories as $category)
                                <option {{ $category->id === $news->category_id ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="">Ảnh đại diện</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Chọn Ảnh</label>
                            <input type="file" name="image" id="image-upload">
                        </div>
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Tiêu đề</label>
                        <input name="title" type="text" class="form-control" value="{{ $news->title }}">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea name="content" class="summernote" id="content">{!! $news->content !!}</textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="">Thẻ</label>
                        <input name="tags" type="text" class="form-control inputtags"
                            value="{{ formatTags($news->tags()->pluck('name')->toArray()) }}">
                        @error('tags')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Tiêu đề SEO</label>
                        <input name="meta_title" type="text" class="form-control" value="{{ $news->meta_title }}">
                        @error('meta_title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Mô tả SEO</label>
                        <textarea name="meta_description" class="form-control">{{ $news->meta_description }}</textarea>
                        @error('meta_description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    @if (canAccess(['News Status', 'News All-Access']))
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="control-label">Trạng Thái</div>
                                    <label class="custom-switch mt-2">
                                        <input value="1" type="checkbox" name="status" class="custom-switch-input"
                                            {{ $news->status === 1 ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="control-label">Tin nóng</div>
                                    <label class="custom-switch mt-2">
                                        <input value="1" type="checkbox" name="is_breaking_news"
                                            class="custom-switch-input"
                                            {{ $news->is_breaking_news === 1 ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="control-label">Hiển thị slider</div>
                                    <label class="custom-switch mt-2">
                                        <input value="1" type="checkbox" name="show_at_slider"
                                            class="custom-switch-input" {{ $news->show_at_slider === 1 ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                    <a href="{{ route('admin.new.index') }}" class="btn btn-danger">Quay Lại</a>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#image-preview').css({
                'background-image': `url({{ asset($news->image) }})`,
                'background-size': 'cover',
                'background-position': 'center',
            });

            $('#language-select').on('change', function() {
                let lang = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.fetch-news-category') }}",
                    data: {
                        lang: lang
                    },
                    success: function(data) {
                        $('#category').html("");
                        $('#category').html(
                            `<option value="">Chọn danh mục</option>`);

                        $.each(data, function(index, data) {
                            $('#category').append(
                                `<option value="${data.id}">${data.name}</option>`)
                        })

                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
