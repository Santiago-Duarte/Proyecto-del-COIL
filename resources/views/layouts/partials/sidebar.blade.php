<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link d-flex justify-content-center align-items-center">
        <img src="{{ asset('img/vetcontrol-logo.svg') }}" alt="VetControl" width="34" height="34">
        <span class="brand-text font-weight-bold ml-2"><span style="font-weight:400; color:#6e7681;">Vet</span>Control</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MANAGEMENT</li>

                <li class="nav-item">
                    <a href="{{ route('pets.index') }}" class="nav-link {{ request()->routeIs('pets.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-paw"></i>
                        <p>Pets</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('owners.index') }}" class="nav-link {{ request()->routeIs('owners.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Owners</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('veterinarians.index') }}" class="nav-link {{ request()->routeIs('veterinarians.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>Veterinarians</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('appointments.index') }}" class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>Appointments</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>