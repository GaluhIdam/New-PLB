<nav class="main-header navbar navbar-expand navbar-light bg-navbar">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/dashboard " class="nav-link">Dashboard</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <img src="./img/default.png" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">

                <li class="user-header bg-plb">
                    <img src="./img/default.png" class="img-circle elevation-2" alt="User Image">
                    <p>
                        {{ Auth::user()->name }}
                        <small>{{ Auth::user()->username }}</small>
                    </p>
                </li>

                <li class="user-footer">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="btn btn-default btn-flat"><i class="fa-solid fa-right-from-bracket"></i>
                        Logout</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </li>
    </ul>
</nav>