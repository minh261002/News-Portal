<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ setSidebarActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>

            @if (canAccess(['Category Index', 'Category Create', 'Category Update', 'Category Delete']))
                <li
                    class=" {{ setSidebarActive(['admin.categories.index', 'admin.categories.create', 'admin.categories.edit']) }}">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">
                        <i class="far fa-square"></i>
                        <span>Danh mục</span>
                    </a>
                </li>
            @endif

            @if (canAccess(['News Index', 'News Create', 'News Update', 'News Delete']))
                <li
                    class="dropdown {{ setSidebarActive(['admin.new.index', 'admin.new.create', 'admin.new.edit', 'admin.news-pending']) }} ">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i>
                        <span>Bài viết</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.new.index', 'admin.new.create', 'admin.new.edit']) }}">
                            <a class="nav-link" href="{{ route('admin.new.index') }}">Tất cả</a>
                        </li>
                        <li class="{{ setSidebarActive(['admin.news-pending']) }}">
                            <a class="nav-link" href="{{ route('admin.news-pending') }}">Chờ Duyệt</a>
                    </ul>
                </li>
            @endif

            @if (canAccess(['Home Section Index', 'Home Section Update']))
                <li class="{{ setSidebarActive(['admin.home-section-setting']) }}">
                    <a class="nav-link" href="{{ route('admin.home-section-setting') }}">
                        <i class="far fa-square"></i>
                        <span>Trang Chủ</span>
                    </a>
                </li>
            @endif

            @if (canAccess(['Language Index', 'Language Create', 'Language Update', 'Language Delete']))
                <li class="{{ setSidebarActive(['admin.subscribers.index']) }}">
                    <a class="nav-link" href="{{ route('admin.subscribers.index') }}">
                        <i class="far fa-square"></i>
                        <span>Đăng Ký</span>
                    </a>
                </li>
            @endif

            @if (canAccess(['Ads Index', 'Ads Update']))
                <li class="{{ setSidebarActive(['admin.ads']) }}">
                    <a class="nav-link" href="{{ route('admin.ads') }}">
                        <i class="far fa-square"></i>
                        <span>Quảng Cáo</span>
                    </a>
                </li>
            @endif

            @if (canAccess([
                    'Access Management Index',
                    'Access Management Create',
                    'Access Management Update',
                    'Access Management Delete',
                ]))
                <li class="dropdown
                {{ setSidebarActive(['admin.role.*', 'admin.role_user.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i>
                        <span>Truy Cập</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.role.*']) }}">
                            <a class="nav-link" href="{{ route('admin.role.index') }}">Phân Quyền</a>
                        </li>

                        <li class="{{ setSidebarActive(['admin.role_user.*']) }}">
                            <a class="nav-link" href="{{ route('admin.role_user.index') }}">Uỷ Quyền</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (canAccess(['Language Index', 'Language Create', 'Language Update', 'Language Delete']))
                <li
                    class="{{ setSidebarActive(['admin.languages.index', 'admin.languages.create', 'admin.languages.edit']) }}">
                    <a class="nav-link" href="{{ route('admin.languages.index') }}">
                        <i class="far fa-square"></i>
                        <span>Ngôn ngữ</span>
                    </a>
                </li>
            @endif
        </ul>
    </aside>
</div>
