@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Bài viết</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Danh sách bài viết</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.new.create') }}" class="btn btn-primary">{{ __('Thêm mới') }}</a>
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
                                $news = \App\Models\News::where('language', $language->lang)
                                    ->orderByDesc('id')
                                    ->get();
                            @endphp
                            <div class="tab-pane fade show {{ $loop->index === 0 ? 'active' : '' }}"
                                id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-{{ $language->lang }}">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th>Ảnh</th>
                                                    <th>Tiêu Đề</th>
                                                    <th>Danh Mục</th>
                                                    <th>Trạng Thái</th>
                                                    <th>Tin Hot</th>
                                                    <th>Slider</th>
                                                    <th>Thao Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($news as $key => $new)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ $key + 1 }}
                                                        </td>
                                                        <td>
                                                            <img src="{{ asset($new->image) }}" alt="{{ $new->title }}"
                                                                style="width: 100px; height:70px; object-fit:cover; padding: 10px 0;">
                                                        </td>
                                                        <td>{{ $new->title }}</td>
                                                        <td>{{ $new->category->name }}</td>
                                                        <td>
                                                            <label class="custom-switch mt-2">
                                                                <input {{ $new->status === 1 ? 'checked' : '' }}
                                                                    data-id="{{ $new->id }}" data-name="status"
                                                                    value="1" type="checkbox"
                                                                    class="custom-switch-input toggle-status">
                                                                <span class="custom-switch-indicator"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="custom-switch mt-2">
                                                                <input {{ $new->is_breaking_news === 1 ? 'checked' : '' }}
                                                                    data-id="{{ $new->id }}"
                                                                    data-name="is_breaking_news" value="1"
                                                                    type="checkbox"
                                                                    class="custom-switch-input toggle-status">
                                                                <span class="custom-switch-indicator"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="custom-switch mt-2">
                                                                <input {{ $new->show_at_slider === 1 ? 'checked' : '' }}
                                                                    data-id="{{ $new->id }}"
                                                                    data-name="show_at_slider" value="1"
                                                                    type="checkbox"
                                                                    class="custom-switch-input toggle-status">
                                                                <span class="custom-switch-indicator"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.new.edit', $new->id) }}"
                                                                class="btn btn-primary">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="{{ route('admin.new.destroy', $new->id) }}"
                                                                class="btn btn-danger delete-item">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <a href="{{ route('admin.news-copy', $new->id) }}"
                                                                class="btn btn-info ">
                                                                <i class="fa fa-copy"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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

            $('.toggle-status').on('click', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.toggle-news-status') }}",
                    data: {
                        id: id,
                        name: name,
                        status: status
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            })
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
