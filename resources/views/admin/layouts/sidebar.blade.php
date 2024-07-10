<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li>
                <a class="nav-link" href="{{ route('admin.categories.index') }}">
                    <i class="far fa-square"></i>
                    <span>Danh mục</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Bài viết</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.new.index') }}">Tất cả</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Chờ Duyệt</a></li>
                </ul>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.home-section-setting') }}">
                    <i class="far fa-square"></i>
                    <span>Trang Chủ</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="{{ route('admin.ads') }}">
                    <i class="far fa-square"></i>
                    <span>Quảng Cáo</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="{{ route('admin.languages.index') }}">
                    <i class="far fa-square"></i>
                    <span>Ngôn ngữ</span>
                </a>
            </li>

        </ul>
    </aside>
</div>
