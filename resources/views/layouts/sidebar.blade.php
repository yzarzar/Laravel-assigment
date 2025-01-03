<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="ml-auto header__pane">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">
                    <i class="mr-2 fas fa-th-large"></i>
                    Dashboards
                </li>
                @can('dashboard')
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->is('home') ? 'mm-active' : '' }}">
                            <i class="fas fa-home metismenu-icon"></i>
                            Home
                        </a>
                    </li>
                @endcan
                @can('role-list')
                    <li>
                        <a href="{{ route('roles.index') }}" class="{{ request()->is('roles*') ? 'mm-active' : '' }}">
                            <i class="fas fa-user-shield metismenu-icon"></i>
                            Roles Management
                        </a>
                    </li>
                @endcan
                @can('permission-list')
                    <li>
                        <a href="{{ route('permissions.index') }}" class="{{ request()->is('permissions*') ? 'mm-active' : '' }}">
                            <i class="fas fa-key metismenu-icon"></i>
                            Permissions
                        </a>
                    </li>
                @endcan
                <li>
                    <a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'mm-active' : '' }}">
                        <i class="fas fa-box metismenu-icon"></i>
                        Products
                    </a>
                </li>
                @can('category-list')
                    <li>
                        <a href="{{ route('categories.index') }}" class="{{ request()->is('categories*') ? 'mm-active' : '' }}">
                            <i class="fas fa-tags metismenu-icon"></i>
                            Categories
                        </a>
                    </li>
                @endcan
                @can('user-list')
                    <li>
                        <a href="{{ route('users.index') }}" class="{{ request()->is('users') || (request()->is('users/*') && !request()->is('users/'.auth()->id())) ? 'mm-active' : '' }}">
                            <i class="fas fa-users metismenu-icon"></i>
                            Users
                        </a>
                    </li>
                @endcan
                <li class="app-sidebar__heading">
                    <i class="mr-2 fas fa-cog"></i>
                    Settings
                </li>
                <li>
                    <a href="{{ route('user.show', auth()->id()) }}" class="{{ request()->is('users/'.auth()->id()) ? 'mm-active' : '' }}">
                        <i class="fas fa-user-circle metismenu-icon"></i>
                        My Profile
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
