<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">RusTest <sup>2</sup></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manage
    </div>

    <!-- Nav Item - Department -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('department.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Departments</span></a>
    </li>

    <!-- Nav Item - Position -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('position.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Position</span></a>
    </li>

    <!-- Nav Item - Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Users</span></a>
    </li>
@can('manage_role_permission')
    <!-- Nav Item - Manage Role & Permission Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
               aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Role & Permission</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('permission.index')}}">Permission</a>
                    <a class="collapse-item" href="{{route('role.index')}}">Role</a>
                </div>
            </div>
        </li>
@endcan
<!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
