@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Bài viết chờ xử lý</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Danh sách bài viết</h4>
                </div>

                <div class="card-body">
                    @php
                        if (canAccess(['News All-Access'])) {
                            $news = \App\Models\News::with('category')
                                ->where('is_approved', 0)
                                ->orderBy('id', 'desc')
                                ->get();
                        } else {
                            $news = \App\Models\News::with('category')
                                ->where('is_approved', 0)
                                ->where('author_id', auth()->guard('admin')->user()->id)
                                ->orderBy('id', 'desc')
                                ->get();
                        }
                    @endphp

                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Ảnh</th>
                                    <th>Tiêu Đề</th>
                                    <th>Danh Mục</th>
                                    @if (canAccess(['News Status', 'News All-Access']))
                                        <th>Xác Nhận</th>
                                    @endif
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
                                        @if (canAccess(['News Status', 'News All-Access']))
                                            <td>
                                                <label class="custom-switch mt-2">
                                                    <input {{ $new->is_approved === 1 ? 'checked' : '' }}
                                                        data-id="{{ $new->id }}" data-name="is_approved" value="1"
                                                        type="checkbox" class="custom-switch-input toggle-status">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('admin.new.edit', $new->id) }}" class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.new.destroy', $new->id) }}"
                                                class="btn btn-danger delete-item">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <a href="{{ route('admin.news-copy', $new->id) }}" class="btn btn-info ">
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
        </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
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
    </script>
@endpush
