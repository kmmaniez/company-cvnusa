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

    <!-- Nav Item - Manage User Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manageUser"
            aria-expanded="true" aria-controls="manageUser">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>Manage Users</span>
        </a>
        <div id="manageUser" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users:</h6>
                <a class="collapse-item" href="#"><i class="fas fa-fw fa-user-pen"></i> Writer/Editor</a>
                <a class="collapse-item" href="#"><i class="fas fa-fw fa-user-tie"></i> Admin</a>
                <a class="collapse-item" href="#"><i class="fas fa-fw fa-user-secret"></i> Super Admin</a>
            </div>
        </div>
    </li> --}}

    <li class="nav-item {{ (request()->routeIs('users.index') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>Manage User</span></a>
    </li>
    
    <!-- Nav Item - Manage Blog -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Manage Blog</span></a>
    </li> --}}

    <!-- Nav Item - Website Settings -->
    <li class="nav-item {{ (request()->routeIs('categories.*') || request()->routeIs('clients.index') ? 'active' : '') }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#projectCategory"
            aria-expanded="true" aria-controls="projectCategory">
            <i class="fas fa-fw fa-book"></i>
            <span>Projects & Client</span></a>
        </a>
        <div id="projectCategory" class="collapse {{ (request()->routeIs('categories.index') || request()->routeIs('clients.index') ? 'show' : '') }}" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Website:</h6>
                <a class="collapse-item {{ (request()->routeIs('categories.index') ? 'bg-primary text-white active' : '') }} " href="{{ route('categories.index') }}"><i class="fas fa-fw fa-list"></i> Project & Category</a>
                {{-- <a class="collapse-item {{ (request()->routeIs('projects.index') ? 'bg-primary text-white active' : '') }}" href="{{ route('projects.index') }}"><i class="fas fa-fw fa-book"></i> Projects</a> --}}
                <a class="collapse-item {{ (request()->routeIs('clients.index') ? 'bg-primary text-white active' : '') }}" href="{{ route('clients.index') }}"><i class="fas fa-fw fa-book"></i> Clients</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pricing -->
    {{-- <li class="nav-item {{ (request()->routeIs('prices.index') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('prices.index') }}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Pricing</span></a>
    </li> --}}

    <!-- Nav Item - Services -->
    <li class="nav-item {{ (request()->routeIs('services.index') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('services.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Services</span></a>
    </li>
    
    <!-- Nav Item - Teams -->
    <li class="nav-item {{ (request()->routeIs('teams.index') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('teams.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Teams</span></a>
    </li>

    <!-- Nav Item - Website Settings -->
     <li class="nav-item {{ (request()->routeIs('website.*') ? 'active' : '') }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manageWebsite"
            aria-expanded="true" aria-controls="manageWebsite">
            <i class="fas fa-fw fa-globe"></i>
            <span>Website Settings</span>
        </a>
        <div id="manageWebsite" class="collapse {{ (request()->routeIs('website.*') ? 'show' : '') }}" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Website:</h6>
                {{-- <a class="collapse-item {{ (request()->routeIs('website.indexabout') ? 'bg-primary text-white active' : '') }} " href="{{ route('website.indexabout') }}"><i class="fas fa-fw fa-info"></i> About Us</a> --}}
                <a class="collapse-item {{ (request()->routeIs('website.indexcarousel') ? 'bg-primary text-white active' : '') }}" href="{{ route('website.indexcarousel') }}"><i class="fas fa-fw fa-image"></i> Carousel Image</a>
                <a class="collapse-item {{ (request()->routeIs('website.indexwallpaper') ? 'bg-primary text-white active' : '') }}" href="{{ route('website.indexwallpaper') }}"><i class="fas fa-fw fa-image"></i> Wallpaper Menu</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>