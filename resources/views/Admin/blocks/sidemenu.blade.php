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
            <li class="nav-label">Status Sticker</li>
            <li class="nav-item {{ @$title == 'status_sticker_category' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/') }}"><i class="fe fe-aperture"></i><span
                        class="sidemenu-label">Category</span></a>
            </li>
            <li class="nav-item {{ @$title == 'status_sticker' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/status_sticker') }}"><i class="fe fe-image"></i><span
                        class="sidemenu-label">Sticker</span></a>
            </li>
            <li class="nav-label">Status Text</li>
            <li class="nav-item {{ @$title == 'status_text_category' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('status_text_category') }}"><i class="fe fe-codepen"></i><span
                        class="sidemenu-label">Category</span></a>
            </li>
            <li class="nav-item {{ @$title == 'status_text' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/status_text') }}"><i class="fe fe-type"></i><span
                        class="sidemenu-label">Text</span></a>
            </li>
            <li class="nav-label">Apps By Sticker Category</li>
            <li class="nav-item {{ @$title == 'appbystickercategory' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/app_by_sticker_category') }}"><i class="fe fe-cpu"></i><span
                        class="sidemenu-label">Category</span></a>
            </li>
            <li class="nav-label">Apps By Text Category</li>
            <li class="nav-item {{ @$title == 'appbytextcategory' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/app_by_text_category') }}"><i class="fe fe-command"></i><span
                        class="sidemenu-label">Category</span></a>
            </li>
            <li class="nav-label">Api Call By User</li>
            <li class="nav-item {{ @$title == 'api_call' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/api_call') }}"><i class="fe fe-user"></i><span
                        class="sidemenu-label">User</span></a>
            </li>
            <li class="nav-label">Apps By Setting</li>
            <li class="nav-item {{ @$title == 'app_setting' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/app_setting') }}"><i class="fe fe-settings"></i><span
                        class="sidemenu-label">Apps</span></a>
            </li>
        </ul>
    </div>
</div>
