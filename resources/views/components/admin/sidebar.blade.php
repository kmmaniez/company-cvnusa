<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-text">Dashboard Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->routeIs('dashboard') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-desktop"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Multiple
    </div>

    <!-- Nav Item - Manage Users -->
    @can('manage-users')
    <li class="nav-item {{ (request()->routeIs('users.index') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>Manage User</span></a>
    </li>
    @endcan

    <!-- Nav Item - Manage Blog -->
    <li class="nav-item {{ request()->routeIs('posts.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('posts.index') }}">
            <i class="fas fa-fw fa-pen"></i>
            <span>Manage Blog</span></a>
    </li>

    <!-- Nav Item - Website Settings -->
    @can('manage-projects')
    <li class="nav-item {{ request()->routeIs('projects.*') || request()->routeIs('clients.index') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#projectCategory"
            aria-expanded="true" aria-controls="projectCategory">
            <i class="fas fa-fw fa-book"></i>
            <span>Projects & Client</span></a>
        </a>
        <div id="projectCategory"
            class="collapse {{ request()->routeIs('projects.*') || request()->routeIs('clients.index') ? 'show' : '' }}"
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Project & Client:</h6>
                <a class="collapse-item {{ (request()->routeIs('projects.*') ? 'bg-primary text-white active' : '') }}" href="{{ route('projects.index') }}"><i class="fas fa-fw fa-book"></i> Projects</a>
                <a class="collapse-item {{ request()->routeIs('clients.index') ? 'bg-primary text-white active' : '' }}" href="{{ route('clients.index') }}"><i class="fas fa-fw fa-user"></i> Clients</a>
            </div>
        </div>
    </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pricing -->
    @can('manage-prices')
    <li class="nav-item {{ (request()->routeIs('prices.index') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('prices.index') }}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Pricing</span></a>
    </li>
    @endcan

    <!-- Nav Item - Services -->
    @can('manage-services')
    <li class="nav-item {{ request()->routeIs('services.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('services.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Services</span></a>
    </li>
    @endcan

    <!-- Nav Item - Teams -->
    @can('manage-teams')
    <li class="nav-item {{ request()->routeIs('teams.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('teams.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Teams</span></a>
    </li>
    @endcan

    <!-- Nav Item - Landing Page Settings -->

    @can('manage-websites')
    <li class="nav-item {{ request()->routeIs('about.*') || request()->routeIs('carousels.*') || request()->routeIs('wallpaper.*') || request()->routeIs('informasi.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manageWebsite"
            aria-expanded="true" aria-controls="manageWebsite">
            <i class="fas fa-fw fa-globe"></i>
            <span>Landing Page Settings</span>
        </a>
        <div id="manageWebsite" class="collapse {{ request()->routeIs('about.*') || request()->routeIs('carousels.*') || request()->routeIs('wallpaper.*') || request()->routeIs('informasi.*') ? 'show' : '' }}"
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Website:</h6>
                <a class="collapse-item {{ (request()->routeIs('about.index') ? 'bg-primary text-white active' : '') }} " href="{{ route('about.index') }}"><i class="fas fa-fw fa-info"></i> About Us</a>
                <a class="collapse-item {{ request()->routeIs('carousels.index') ? 'bg-primary text-white active' : '' }}"href="{{ route('carousels.index') }}"><i class="fas fa-fw fa-image"></i> Carousel Image</a>
                <a class="collapse-item {{ (request()->routeIs('wallpaper.index') ? 'bg-primary text-white active' : '') }}" href="{{ route('wallpaper.index') }}"><i class="fas fa-fw fa-images"></i> Wallpaper Menu</a>
                <a class="collapse-item {{ (request()->routeIs('informasi.index') ? 'bg-primary text-white active' : '') }}" href="{{ route('informasi.index') }}"><i class="fas fa-fw fa-info-circle"></i> Informasi Website</a>
            </div>
        </div>
    </li>

    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    @endcan


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
