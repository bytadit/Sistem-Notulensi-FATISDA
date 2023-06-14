<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/minot_full.png') }}" alt="" height="52">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/minot_full.png') }}" alt="" height="52">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }} menu-link" href="{{ route('dashboard.index') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="mdi mdi-speedometer"></i> <span>Halaman Utama</span>
                    </a>
                </li>
                @role('superadministrator')
                <li class="menu-title"><span>MENU SUPER ADMIN</span></li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('manage-users') ? 'active' : '' }} menu-link" href="/manage-users" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="mdi mdi-view-grid-plus-outline"></i> <span>Atur User</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('manage-units') ? 'active' : '' }} menu-link" href="/dashboard/superadmin/manage-units" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="mdi mdi-view-grid-plus-outline"></i> <span>Atur Unit</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('manage-jabatan') ? 'active' : '' }} menu-link" href="/dashboard/superadmin/manage-jabatan" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="mdi mdi-view-grid-plus-outline"></i> <span>Atur Jabatan</span>
                    </a>
                </li>
                @endrole
                @role('administrator')
                <li class="menu-title"><span>MENU ADMIN</span></li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/admin/manage-pejabat') ? 'active' : '' }} menu-link" href="{{ route('manage-pejabat') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="mdi mdi-view-grid-plus-outline"></i> <span>Atur Pejabat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/admin/daftar-rapat') ? 'active' : '' }} menu-link" href="{{ route('daftar-rapat') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="mdi mdi-speedometer"></i> <span>Daftar Rapat</span>
                    </a>
                    {{-- <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-analytics" class="nav-link">@lang('translation.analytics')</a>
                            </li>
                        </ul>
                    </div> --}}
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/admin/kategori-rapat') ? 'active' : '' }} menu-link" href="{{ route('kategori-rapat') }}" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="mdi mdi-view-grid-plus-outline"></i> <span>Kategori Rapat</span>
                    </a>
                    {{-- <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="apps-calendar" class="nav-link">@lang('translation.calendar')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="apps-chat" class="nav-link">@lang('translation.chat')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarEmail" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEmail" data-key="t-email">
                                    Email
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEmail">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-mailbox" class="nav-link">@lang('translation.mailbox')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebaremailTemplates" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebaremailTemplates" data-key="t-email-templates">
                                                @lang('translation.email-templates') <span class="badge badge-pill bg-danger" data-key="t-new"> @lang('translation.new')</span>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebaremailTemplates">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="apps-email-basic" class="nav-link" data-key="t-basic-action"> @lang('translation.basic-action') </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="apps-email-ecommerce" class="nav-link" data-key="t-ecommerce-action"> @lang('translation.ecommerce-action') </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/admin/topik-rapat') ? 'active' : '' }} menu-link" href="{{ route('topik-rapat') }}" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="mdi mdi-view-carousel-outline"></i> <span>Topik Rapat</span>
                    </a>
                    {{-- <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal" class="nav-link" target="_blank">@lang('translation.horizontal')
                                </a>
                            </li>
                        </ul>
                    </div> --}}
                </li> <!-- end Dashboard Menu -->
                @endrole
                @role('user')
                <li class="menu-title"><i class="ri-more-fill"></i> <span>MENU ANGGOTA</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="mdi mdi-account-circle-outline"></i> <span>Rapat Saya</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#sidebarSignIn" class="nav-link" role="button" aria-expanded="false" aria-controls="sidebarSignIn">
                                    Jadwal Rapat
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarSignIn" class="nav-link" role="button" aria-expanded="false" aria-controls="sidebarSignIn">
                                    Riwayat Rapat
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="#sidebarSignUp" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSignUp">
                                    Riwayat Rapat
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSignUp">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-signup-basic" class="nav-link">@lang('translation.basic')
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-signup-cover" class="nav-link">@lang('translation.cover')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPages"  role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <i class="mdi mdi-sticker-text-outline"></i> <span>Statistik Rapat</span>
                    </a>
                </li>
                @endrole
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
