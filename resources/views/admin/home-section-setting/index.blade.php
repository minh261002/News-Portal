@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Danh mục trang chủ') }}</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Danh sách danh mục') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">{{ __('Thêm mới') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        @foreach ($languages as $language)
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->index === 0 ? 'active' : '' }}" id="home-tab2"
                                    data-toggle="tab" href="#home-{{ $language->lang }}" role="tab" aria-controls="home"
                                    aria-selected="true">{{ $language->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content tab-bordered" id="myTab3Content">
                        @foreach ($languages as $language)
                            @php
                                $categories = \App\Models\Category::where('language', $language->lang)
                                    ->orderByDesc('id')
                                    ->get();

                                $homeSectionSetting = \App\Models\HomeSectionSetting::where(
                                    'language',
                                    $language->lang,
                                )->first();
                            @endphp

                            <div class="tab-pane fade show {{ $loop->index === 0 ? 'active' : '' }}"
                                id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                                <form class="card-body" action="{{ route('admin.home-section-setting.update') }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="language" value="{{ $language->lang }}">
                                    <div class="form-group">
                                        <label for="">Chọn danh mục 1</label>
                                        <select name="category_section_1" class="form-control select2">
                                            <option value="">-- Chọn danh mục --</option>
                                            @foreach ($categories as $category)
                                                <option
                                                    {{ @$homeSectionSetting->category_section_1 == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('category_section_1')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Chọn danh mục 2</label>
                                        <select name="category_section_2" class="form-control select2">
                                            <option value="">-- Chọn danh mục --</option>
                                            @foreach ($categories as $category)
                                                <option
                                                    {{ @$homeSectionSetting->category_section_2 == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('category_section_2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Chọn danh mục 3</label>
                                        <select name="category_section_3" class="form-control select2">
                                            <option value="">-- Chọn danh mục --</option>
                                            @foreach ($categories as $category)
                                                <option
                                                    {{ @$homeSectionSetting->category_section_3 == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('category_section_3')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Chọn danh mục 4</label>
                                        <select name="category_section_4" class="form-control select2">
                                            <option value="">-- Chọn danh mục --</option>
                                            @foreach ($categories as $category)
                                                <option
                                                    {{ @$homeSectionSetting->category_section_4 == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('category_section_4')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Chọn danh mục 5</label>
                                        <select name="category_section_5" class="form-control select2">
                                            <option value="">-- Chọn danh mục --</option>
                                            @foreach ($categories as $category)
                                                <option
                                                    {{ @$homeSectionSetting->category_section_5 == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('category_section_5')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('Lưu thay đổi') }}</button>
                                    </div>
                                </form>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            @foreach ($languages as $language)
                $('#table-{{ $language->lang }}').DataTable({
                    "language": {
                        "url": "/data.json"
                    }
                });
            @endforeach
        });
    </script>
@endpush
