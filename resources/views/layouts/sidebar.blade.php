<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/home">
        <span class="align-middle">Slip Gaji</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item @if(request()->is('home')) active @endif">
                <a class="sidebar-link" href="/home">
                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item @if(request()->is('role/karyawan*')) active @endif">
                <a class="sidebar-link" href="{{ route('role.show', 'karyawan') }}">
                <i class="align-middle" data-feather="users"></i> <span class="align-middle">Karyawan</span>
                </a>
            </li>

            <li class="sidebar-item @if(request()->is('role/admin*')) active @endif">
                <a class="sidebar-link" href="{{ route('role.show', 'admin') }}">
                <i class="align-middle" data-feather="users"></i> <span class="align-middle">Admin</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
