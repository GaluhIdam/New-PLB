<aside class="main-sidebar sidebar-dark-aircraft elevation-1 ">

    <div class="brand-link d-flex justify-content-between align-items-center">
        <a href="#" class="brand-link">
            <img src="{{ asset('/img/logo-gmf.png') }}" alt="Logo GMF AeroAsia"
                class="brand-image" style="opacity: .8">
            <span class="brand-text ">GMF AeroAsia</span>
        </a>
    </div>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header">Navigation Menu</li>
                <li class="nav-item menu-open">
                    <router-link to="/home" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                        </a>
                </li>
                <li class="nav-item ">
                    <router-link to="/mutation" class="nav-link">
                        <i class="nav-icon fa-solid fa-plane-circle-exclamation"></i>
                        <p>
                            Aircraft Mutation
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </router-link>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/delivery" class="nav-link">
                                <i class="nav-icon fa-solid fa-plane-departure"></i>
                                <p>Aircraft Delivery</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <i class="nav-icon fa-solid fa-plane-arrival"></i>
                                <p>Aircraft Redelivery</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Menu Lainnya</li>
                <li class="nav-item">
                    <router-link to="/data-users" class="nav-link">
                        <i class="nav-icon fa-solid fa-user-group"></i>
                        <p>Daftar Pengguna</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/users-role" class="nav-link">
                        <i class="nav-icon fa-solid fa-user-gear"></i>
                        <p>Role Pengguna</p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa-solid fa-right-from-bracket text-danger"></i>
                        <p class="text">Keluar</p>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </nav>
    </div>
</aside>