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
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('dashboard.index') }}" role="button" aria-expanded="false"
                        aria-controls="sidebarDashboards">
                        <i class="mdi mdi-speedometer"></i> <span>Halaman Utama</span>
                    </a>
                </li>
                {{-- start SuperAdmin Menu --}}
                @if (Auth::user()->roles()->where('name', 'superadministrator')->count() > 0)
                    <li class="menu-title"><span>MENU SUPER ADMIN</span></li>
                @endif
                {{-- @foreach (\App\Models\Team::latest()->get() as $team) --}}
                @if (Auth::user()->hasRole('superadministrator'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#menuSuperAdmin{{ Auth::user()->id . 'superadmin' }}"
                            data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="superAdminMenu">
                            <i class="mdi mdi-speedometer"></i> Hak Akses
                            </span>
                        </a>
                        <div class="collapse menu-dropdown" id="menuSuperAdmin{{ Auth::user()->id . 'superadmin' }}">
                            <ul class="nav nav-sm flex-column">
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link menu-link" href="/manage-users" role="button"--}}
{{--                                        aria-expanded="false" aria-controls="sidebarApps">--}}
{{--                                        <i class="mdi mdi-view-grid-plus-outline"></i> <span>Atur User</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="/dashboard/superadmin/manage-users" role="button"
                                       aria-expanded="false" aria-controls="sidebarApps">
                                        <i class="mdi mdi-view-grid-plus-outline"></i> <span>Atur User</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="/dashboard/superadmin/manage-roles" role="button"
                                       aria-expanded="false" aria-controls="sidebarApps">
                                        <i class="mdi mdi-view-grid-plus-outline"></i> <span>Atur Role</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="/dashboard/superadmin/manage-permissions" role="button"
                                       aria-expanded="false" aria-controls="sidebarApps">
                                        <i class="mdi mdi-view-grid-plus-outline"></i> <span>Atur Permission</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  menu-link" href="/dashboard/superadmin/manage-units"
                                        role="button" aria-expanded="false" aria-controls="sidebarApps">
                                        <i class="mdi mdi-view-grid-plus-outline"></i> <span>Atur Unit</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  menu-link" href="/dashboard/superadmin/manage-jabatan"
                                        role="button" aria-expanded="false" aria-controls="sidebarApps">
                                        <i class="mdi mdi-view-grid-plus-outline"></i> <span>Atur Jabatan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                {{-- @endforeach --}}
                {{-- end SuperAdmin Menu --}}
                {{-- start Administrator Menu --}}
                @if (Auth::user()->roles()->where('name', 'administrator')->count() > 0)
                    <li class="menu-title"><span>MENU ADMIN</span></li>
                @endif
                @foreach (\App\Models\Team::latest()->get() as $team)
                    @if (Auth::user()->hasRole('administrator', \App\Models\Team::where('name', $team->name)->first()))
                        <li class="nav-item">
                            <a class="nav-link menu-link"
                                href="#menuAdmin{{ Auth::user()->id . $team->name . 'admin' }}"
                                data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="adminMenu">
                                <i class="mdi mdi-speedometer"></i> {{ $team->display_name }}
                                </span>
                            </a>
                            <div class="collapse menu-dropdown"
                                id="menuAdmin{{ Auth::user()->id . $team->name . 'admin' }}">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link  menu-link" href="/dashboard/admin/{{ $team->id }}/kategori-rapat" role="button"
                                           aria-expanded="false" aria-controls="sidebarApps">
                                            <i class="mdi mdi-view-grid-plus-outline"></i> <span>Kategori Rapat</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="/dashboard/admin/{{ $team->id }}/topik-rapat" role="button"
                                           aria-expanded="false" aria-controls="sidebarLayouts">
                                            <i class="mdi mdi-view-carousel-outline"></i> <span>Topik Rapat</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="/dashboard/admin/{{ $team->id }}/manage-pejabat" role="button"
                                            aria-expanded="false" aria-controls="sidebarDashboards">
                                            <i class="mdi mdi-view-grid-plus-outline"></i> <span>Atur Pejabat</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="/dashboard/admin/{{ $team->id }}/daftar-rapat" role="button"
                                            aria-expanded="false" aria-controls="sidebarDashboards">
                                            <i class="mdi mdi-speedometer"></i> <span>Daftar Rapat</span>
                                        </a>

                                    </li>
                                    <!-- end Dashboard Menu -->
                                </ul>
                            </div>
                        </li>
                    @endif
                @endforeach
                {{-- end Administrator Menu --}}
                {{-- {{ Auth::user()->rolesTeams()->where('name','011')->first() }} --}}
                {{-- {{ Request::is('dashboard/admin/1/topik-rapat') ? 'active' : '' }}  --}}
                {{-- start User Menu --}}
                @if (Auth::user()->roles()->where('name', 'user')->count() > 0)
                    <li class="menu-title"><span>MENU USER</span></li>
                @endif
                @foreach (\App\Models\Team::latest()->get() as $team)
                    @if (Auth::user()->hasRole('user', \App\Models\Team::where('name', $team->name)->first()))
                        <li class="nav-item">
                            <a class="nav-link menu-link"
                                href="#menuUser{{ Auth::user()->id . $team->name . 'user' }}"
                                data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="userMenu">
                                <i class="mdi mdi-speedometer"></i> {{ $team->display_name }}
                                </span>
                            </a>
                            <div class="collapse menu-dropdown"
                                id="menuUser{{ Auth::user()->id . $team->name . 'user' }}">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse"
                                            role="button" aria-expanded="false" aria-controls="sidebarAuth">
                                            <i class="mdi mdi-account-circle-outline"></i> <span>Rapat Saya</span>
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarAuth">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="{{ route('jadwal-rapat', ['team' => $team->id]) }}" class="nav-link" role="button"
                                                        aria-expanded="false" aria-controls="sidebarSignIn">
                                                        Jadwal Rapat
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('riwayat-rapat', ['team' => $team->id]) }}" class="nav-link" role="button"
                                                        aria-expanded="false" aria-controls="sidebarSignIn">
                                                        Riwayat Rapat
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link menu-link" href="#sidebarPages" role="button"--}}
{{--                                            aria-expanded="false" aria-controls="sidebarPages">--}}
{{--                                            <i class="mdi mdi-sticker-text-outline"></i> <span>Statistik Rapat</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
                                </ul>
                            </div>
                        </li>
                    @endif
                @endforeach
                {{-- end User Menu --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
