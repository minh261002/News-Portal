@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Danh sách người đăng ký nhận tin') }}</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Gửi email thông báo') }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.subscribers.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Tiêu đề</label>
                            <input type="text" class="form-control" name="subject">
                            @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Nội dung</label>
                            <textarea name="content" class="summernote" rows="5"></textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-primary">{{ __('Gửi') }}</button>
                    </form>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Danh sách người đăng ký nhận tin') }}</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Ngày đăng ký') }}</th>
                                    <th>{{ __('Thao tác') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscribers as $subscriber)
                                    <tr>
                                        <td>{{ $subscriber->id }}</td>
                                        <td>{{ $subscriber->email }}</td>
                                        <td>{{ $subscriber->created_at }}</td>
                                        <td>
                                            <button class="btn btn-danger delete-item"
                                                href="{{ route('admin.subscribers.destroy', $subscriber->id) }}">{{ __('Xóa') }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
