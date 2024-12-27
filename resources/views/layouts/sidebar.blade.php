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
                    <i class="fas fa-th-large mr-2"></i>
                    Dashboards
                </li>
                <li>
                    <a href="{{ route('home') }}" class="mm-active">
                        <i class="fas fa-home metismenu-icon"></i>
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}" class="mm-active">
                        <i class="fas fa-box metismenu-icon"></i>
                        Products
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}" class="mm-active">
                        <i class="fas fa-tags metismenu-icon"></i>
                        Categories
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}" class="mm-active">
                        <i class="fas fa-users metismenu-icon"></i>
                        Users
                    </a>
                </li>
                <li class="app-sidebar__heading">
                    <i class="fas fa-cog mr-2"></i>
                    Settings
                </li>
                <li>
                    <a href="{{ route('user.show', auth()->id()) }}" class="mm-active">
                        <i class="fas fa-user-circle metismenu-icon"></i>
                        My Profile
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
