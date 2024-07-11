@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Phân Quyền Người Dùng</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Tất cả quyền</h4>

                    <div class="card-header-action">
                        <a href="{{ route('admin.role.create') }}" class="btn btn-primary">Thêm Mới</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Quyền</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach ($role->permissions as $permission)
                                            <span class="badge badge-primary">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.role.destroy', $role->id) }}"
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
