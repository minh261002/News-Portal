@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Ngôn ngữ') }}</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Danh sách ngôn ngữ') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.languages.create') }}" class="btn btn-primary">{{ __('Thêm mới') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>{{ __('STT') }}</th>
                                <th>{{ __('Ngôn ngữ') }}</th>
                                <th>{{ __('Mã') }}</th>
                                <th>{{ __('Mặc định') }}</th>
                                <th>{{ __('Trạng thái') }}</th>
                                <th>{{ __('Hành động') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($languages as $lang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $lang->name }}</td>
                                    <td>{{ $lang->lang }}</td>
                                    <td>
                                        @if ($lang->default == 1)
                                            <span class="badge badge-success">{{ __('Mặc định') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('Không') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lang->status == 1)
                                            <span class="badge badge-success">{{ __('Kích hoạt') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('Không kích hoạt') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.languages.edit', $lang->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.languages.destroy', $lang->id) }}"
                                            class="btn btn-danger delete-item">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script></script>
@endpush
