<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <span class="nav-link text-muted">{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" title="Log out" role="button" aria-label="Log out">
                <i class='fas fa-power-off'></i>
            </a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                @csrf
            </form>
        </li>
    </ul>
</nav>