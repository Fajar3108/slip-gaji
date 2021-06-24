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

            <li class="sidebar-item @if(request()->is('user*')) active @endif">
                <a class="sidebar-link" href="{{ route('user.index') }}">
                <i class="align-middle" data-feather="users"></i> <span class="align-middle">User</span>
                </a>
            </li>

            <li class="sidebar-item @if(request()->is('salary')) active @endif">
                <a class="sidebar-link" href="{{ route('salary.index') }}">
                <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Salary</span>
                </a>
            </li>

            <li class="sidebar-item @if(request()->is('setting')) active @endif">
                <a class="sidebar-link" href="{{ route('salary.index') }}">
                <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
