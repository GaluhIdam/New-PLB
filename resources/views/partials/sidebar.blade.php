<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <div class="brand-link d-flex justify-content-between align-items-center">
        <a href="/dashboard" class="brand-link logo-switch">
            <img src="{{ asset('/img/logo-xs.png') }}" alt="Logo PLB Report XS" class="brand-image-xl logo-xs">
            <img src="{{ asset('/img/logo-xl.png') }}" alt="Logo PLB Report XL" class="brand-image-xs logo-xl">
        </a>
    </div>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <router-link to="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                        </a>
                </li>
                <li class="nav-header"> Report</li>

                <!-- BEGIN: Dokumen Kepabeanan -->
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-lines"></i>
                        <p>
                            Dokumen Kepabeanan
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/inbound-document" class="nav-link">
                                <p>Dokumen Pemasukan PLB</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/outbound-document" class="nav-link">
                                <p>Dokumen Pengeluaran PLB</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <!-- END: Dokumen Kepabeanan -->

                <!-- BEGIN: Outbound -->
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-money-bill-transfer"></i>
                        <p>
                            Outbound
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/outbound-transcation" class="nav-link">
                                <p>Outbound Transaction</p>
                            </router-link>
                        </li>
                        {{-- <li class="nav-item">
                            <router-link to="/summary-outbound" class="nav-link">
                                <p>Summary Outbound</p>
                            </router-link>
                        </li> --}}
                    </ul>
                </li>
                <!-- END: Outbound -->

                <!-- BEGIN: Aircraft Mutation -->
                @can('isUser')
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-plane-circle-exclamation"></i>
                        <p>
                            Aircraft
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/aircraft-mutation" class="nav-link">
                                <p>Mutation</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('isAdminOrPlanner')
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-plane-circle-exclamation"></i>
                        <p>
                            Aircraft
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/aircraft-mutation" class="nav-link">
                                <p>Mutation</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/aircraft-delivery" class="nav-link">
                                <p>Delivery</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/aircraft-redelivery" class="nav-link">
                                <p>Redelivery</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                @endcan
                <!-- END: Aircraft Mutation -->

                <!-- BEGIN: Allotment -->
                {{-- <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-warehouse"></i>
                        <p>
                            Allotment
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/inventory-allotment" class="nav-link">
                                <p>Inventory Allotment</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/movement-allotment" class="nav-link">
                                <p>Movement Allotment</p>
                            </router-link>
                        </li>
                    </ul>
                </li> --}}
                <!-- END: Allotment -->

                <!-- BEGIN: Mutasi -->
                @can('isAdmin')
                <li class="nav-item ">
                    <a href="#" class=" nav-link">
                        <i class="nav-icon fa-solid fa-file-circle-exclamation"></i>
                        <p>Mutasi<i class="right fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/report-mutation" class="nav-link">
                                <p>Report Mutasi</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                @endcan

                {{-- BEGIN: Scrap --}}
                {{-- <li class="nav-item">
                    <router-link to="/scrap" class="nav-link">
                        <i class="nav-icon fa-solid fa-oil-well"></i>
                        <p>Scrap</p>
                    </router-link>
                </li> --}}
                {{-- END: Scrap --}}


                <!-- BEGIN: Masa Timbun -->
                {{-- <li class="nav-item">
                    <router-link to="/hoarding-time" class="nav-link">
                        <i class="nav-icon fa-solid fa-hands-holding-circle"></i>
                        <p>Masa Timbun</p>
                    </router-link>
                </li> --}}
                <!-- END: Masa Timbun -->
                @can('isAdminOrPlanner')
                <!-- BEGIN: Data Upload -->
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-cloud-arrow-up"></i>
                        <p>Data Upload<i class="right fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="upload-mutation" class="nav-link">
                                <p>Data Mutasi</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-cloud-arrow-up"></i>
                        <p>Data Upload<i class="right fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="#" class="nav-link">
                                <p>Data Mutasi</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="#" class="nav-link">
                                <p>Data Barang BC 3.0</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="#" class="nav-link">
                                <p>Data Header BC 3.0</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="#" class="nav-link">
                                <p>Data Dokumen BC 3.0</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="#" class="nav-link">
                                <p>Data Scan Dokumen</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="#" class="nav-link">
                                <p>Data Stok Opname</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="#" class="nav-link">
                                <p>Data Movement OSA</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="#" class="nav-link">
                                <p>Install/Consume OSA</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="#" class="nav-link">
                                <p>List Movement to OSA</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="#" class="nav-link">
                                <p>List Install/Consume OSA
                                </p>
                            </router-link>
                        </li>
                    </ul>
                </li> --}}
                <!-- END: Data Upload -->
                @endcan

                <li class="nav-header">Miscellaneous</li>
                @can('isAdmin')
                <!-- BEGIN: User Management -->
                <li class="nav-item ">
                    <router-link to="/users-list" class="nav-link">
                        <i class="nav-icon fa-solid fa-user-gear"></i>
                        <p> User Management</p>
                    </router-link>
                </li>

                <!-- END: User Management -->
                <!-- BEGIN: Log -->
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-server"></i>
                        <p>
                            Log
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/login-history" class="nav-link">
                                <p>Login History</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/activity-history" class="nav-link">
                                <p>Activity History</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <!-- END: Log -->
                @endcan
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa-solid fa-right-from-bracket"></i>
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