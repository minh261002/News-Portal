@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Uỷ quyền người dùng') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Tất cả tài khoản') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.role_user.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Thêm Mới') }}
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>{{ __('Họ và tên') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Quyền') }}</th>
                                <th>{{ __('Thao Tác') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($admins as $key => $user)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 }}
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        <span class="badge badge-primary"> {{ $user->getRoleNames()->first() }}</span>
                                    </td>
                                    <td>
                                        @if ($user->getRoleNames()->first() !== 'Admin')
                                            <a href="{{ route('admin.role_user.edit', $user->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.role_user.destroy', $user->id) }}"
                                                class="btn btn-danger btn-sm delete-item">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endif
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
