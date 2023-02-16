<div class="main-sidebar main-sidebar-sticky side-menu">
    <div class=" sidemenu-logo">
        <a class="main-logo" href="{{ url('/') }}">
            <img src="{{ asset('logo.png') }}" class="header-brand-img desktop-logo">
            <img src="{{ asset('logo1.png') }}" class="header-brand-img icon-logo">
            <img src="{{ asset('logo1.png') }}" class="header-brand-img desktop-logo theme-logo">
            <img src="{{ asset('logo1.png') }}" class="header-brand-img icon-logo theme-logo">
        </a>
    </div>
    <div class="main-sidebar-body">
        <ul class="nav">
            <li class="nav-label">Category</li>
            <li class="nav-item {{ @$title == 'category' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/') }}"><i class="fe fe-aperture"></i><span
                        class="sidemenu-label">Category</span></a>
            </li>
            <li class="nav-label">Category By Sticker</li>
            <li class="nav-item {{ @$title == 'sticker' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/category_stickers') }}"><i class="fe fe-image"></i><span
                        class="sidemenu-label">Sticker</span></a>
            </li>
            <li class="nav-label">App By Sticker Category</li>
            <li class="nav-item {{ @$title == 'appbystickercategory' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/app_by_sticker_category') }}"><i class="fe fe-cpu"></i><span
                        class="sidemenu-label">Category</span></a>
            </li>
            <li class="nav-label">Api Call By User</li>
            <li class="nav-item {{ @$title == 'api_call' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/api_call') }}"><i class="fe fe-user"></i><span
                        class="sidemenu-label">User</span></a>
            </li>
            <li class="nav-label">App By Setting</li>
            <li class="nav-item {{ @$title == 'appsetting' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/app_setting') }}"><i class="fe fe-settings"></i><span
                        class="sidemenu-label">App</span></a>
            </li>
        </ul>
    </div>
</div>
