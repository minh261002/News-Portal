@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Danh mục bài viết') }}</h1>
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
                                                    <th>Danh Mục</th>
                                                    <th>Ngôn Ngữ</th>
                                                    <th>Hiển Thị</th>
                                                    <th>Trạng Thái</th>
                                                    <th>Thao Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td>{{ $category->id }}</td>
                                                        <td>{{ $category->name }}</td>
                                                        <td>{{ $category->language }}</td>
                                                        <td>
                                                            @if ($category->show_at_nav == 1)
                                                                <span class="badge badge-success">Hiển Thị</span>
                                                            @else
                                                                <span class="badge badge-danger">Không Hiển Thị</span>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if ($category->status == 1)
                                                                <span class="badge badge-success">Kích Hoạt</span>
                                                            @else
                                                                <span class="badge badge-danger">Không Kích Hoạt</span>
                                                            @endif

                                                        </td>


                                                        <td>
                                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                                class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                            <a href="{{ route('admin.categories.destroy', $category->id) }}"
                                                                class="btn btn-danger delete-item"><i
                                                                    class="fas fa-trash-alt"></i></a>
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
        });
    </script>
@endpush
