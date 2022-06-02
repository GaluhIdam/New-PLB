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
                <li class="nav-item menu-open">
                    <router-link to="/home" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                        </a>
                </li>
                <li class="nav-header"> Report</li>

                <!-- BEGIN: Dokumen Kepabeanan -->
                <li class="nav-item ">
                    <router-link to="/mutation" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-lines"></i>
                        <p>
                            Dokumen Kepabeanan
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </router-link>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/delivery" class="nav-link">
                                <p>Dokumen Pemasukan PLB</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Dokumen Pengeluaran PLB</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <!-- END: Dokumen Kepabeanan -->

                <!-- BEGIN: Mutasi Pesawat -->
                <li class="nav-item ">
                    <router-link to="/mutation" class="nav-link">
                        <i class="nav-icon fa-solid fa-plane-circle-exclamation"></i>
                        <p>
                            Mutasi Pesawat
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </router-link>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/delivery" class="nav-link">
                                <p>Aircraft Delivery</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Aircraft Redelivery</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <!-- END: Mutasi Pesawat -->

                <!-- BEGIN: Allotment -->
                <li class="nav-item ">
                    <router-link to="/mutation" class="nav-link">
                        <i class="nav-icon fa-solid fa-money-bill-transfer"></i>
                        <p>
                            Allotment
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </router-link>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/delivery" class="nav-link">
                                <p>Inventory Allotment</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Movement Allotment</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <!-- END: Allotment -->

                <!-- BEGIN: Mutasi -->
                <li class="nav-item ">
                    <router-link to="/mutation" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-circle-exclamation"></i>
                        <p>Mutasi<i class="right fas fa-angle-right"></i></p>
                    </router-link>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/delivery" class="nav-link">
                                <p>Report Mutasi</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Report Mutasi Berkala</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Report Perhitungan Mutasi</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <!-- END: Mutasi -->
                <!-- BEGIN: Scrap -->
                <li class="nav-item">
                    <router-link to="/data-users" class="nav-link">
                        <i class="nav-icon fa-solid fa-oil-well"></i>
                        <p>Scrap</p>
                    </router-link>
                </li>
                <!-- END: Scrap -->

                <!-- BEGIN: Masa Timbun -->
                <li class="nav-item">
                    <router-link to="/data-users" class="nav-link">
                        <i class="nav-icon fa-solid fa-hands-holding-circle"></i>
                        <p>Masa Timbun</p>
                    </router-link>
                </li>
                <!-- END: Masa Timbun -->
                <li class="nav-header">Master Data</li>
                <!-- BEGIN: Data Upload -->
                <li class="nav-item ">
                    <router-link to="/mutation" class="nav-link">
                        <i class="nav-icon fa-solid fa-cloud-arrow-up"></i>
                        <p>Data Upload<i class="right fas fa-angle-right"></i></p>
                    </router-link>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/delivery" class="nav-link">
                                <p>Data Mutasi</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Data Barang BC 3.0</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Data Header BC 3.0</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Data Dokumen BC 3.0</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Data Scan Dokumen</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Data Stok Opname</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Data Movement OSA</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Install/Consume OSA</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>List Movement to OSA</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>List Install/Consume OSA
                                </p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <!-- END: Data Upload -->

                <li class="nav-header">Miscellaneous</li>
                <!-- BEGIN: User Management -->
                <li class="nav-item ">
                    <router-link to="/mutation" class="nav-link">
                        <i class="nav-icon fa-solid fa-user-gear"></i>
                        <p>
                            User Management
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </router-link>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/delivery" class="nav-link">
                                <p>Daftar Pengguna</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Role Pengguna</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <!-- END: User Management -->
                <!-- BEGIN: Log -->
                <li class="nav-item ">
                    <router-link to="/mutation" class="nav-link">
                        <i class="nav-icon fa-solid fa-server"></i>
                        <p>
                            Log
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </router-link>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/delivery" class="nav-link">
                                <p>Login History</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/redelivery" class="nav-link">
                                <p>Activity History</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <!-- END: Log -->

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