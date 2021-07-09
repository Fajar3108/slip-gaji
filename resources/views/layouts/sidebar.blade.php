<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/home">
        <span class="align-middle">Slip Gaji</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item @if(request()->is('user*')) active @endif">
                <a class="sidebar-link" href="{{ route('user.index') }}">
                <i class="align-middle" data-feather="users"></i> <span class="align-middle">User</span>
                </a>
            </li>

            <li class="sidebar-item @if(request()->is('salary*')) active @endif">
                <a class="sidebar-link" href="{{ route('salary.index') }}">
                <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Salary</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
