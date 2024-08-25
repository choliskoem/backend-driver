<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Dapoer Dindra</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">DD</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('dashboard') }}">Genera Dashboard</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Pembelian</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('pembelian.index') }}">All Pembelian</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Periode</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('periode.index') }}">All Periode</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Point</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('point.index') }}">All Point</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('user.index') }}">All Users</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Undian</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('roulette.index') }}">All Users</a>
                    </li>

                </ul>
            </li>
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Driver</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('driver.index') }}">All Drivers</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Backup</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('backup.index') }}">All Backup</a>
                    </li>

                </ul>
            </li> --}}
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Management</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('option.index') }}">All Options</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('category.index') }}">All Categories</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('type.index') }}">All Types</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('question.index') }}">All Question</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('schedule.index') }}">All Schedule</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('typeoption.index') }}">Type Options</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('typequestion.index') }}">Type Questions</a>
                    </li>




                </ul>
            </li> --}}
    </aside>
</div>
