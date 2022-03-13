        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

         

            <!-- Nav Item - Pages Collapse Menu -->
            {{-- ==================== ADMIN ===================== --}}
            @if (auth()->user()->role==0 )
            <li class="nav-item {{Request::is('datasiswa') ? 'active' : ''}} ">
                <a class="nav-link" href="/datasiswa">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Data Siswa</span></a>
            </li>

            <li class="nav-item {{Request::is('pelatih') ? 'active' : ''}} ">
                <a class="nav-link" href="/pelatih">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Data Pelatih</span></a>
            </li>

            <li class="nav-item {{Request::is('kepalasekolah') ? 'active' : ''}} ">
                <a class="nav-link" href="/kepalasekolah">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Data Kepala Sekolah</span></a>
            </li>

            <li class="nav-item {{Request::is('dataekskul') ? 'active' : ''}} {{Request::is('informasiekskul') ? 'active' : ''}}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Ekskul</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Ekskul:</h6>
                        <a class="collapse-item" href="/dataekskul">Data Ekskul</a>
                        <a class="collapse-item" href="/informasiekskul">Informasi Ekskul</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/datasiswa">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Hasil Seleksi</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/datasiswa">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Agenda</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/datasiswa">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Prestasi</span></a>
            </li>

            <li class="nav-item {{Request::is('nilaisiswa') ? 'active' : ''}}">
                <a class="nav-link" href="/nilaisiswa">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Nilai</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/datasiswa">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Pengumuman</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/datasiswa">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Absen</span></a>
            </li>         
            @endif
            {{-- ==================== END ADMIN ===================== --}}

            {{-- ==================== SISWA ===================== --}}
            @if (auth()->user()->role == 1)
            <li class="nav-item {{Request::is('biodata') ? 'active' : ''}} ">
                <a class="nav-link" href="/biodata">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Biodata Siswa</span></a>
            </li>

            <li class="nav-item {{Request::is('ekskul') ? 'active' : ''}} ">
                <a class="nav-link" href="/ekskul">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Ekskul</span></a>
            </li>

            @endif
            {{-- ==================== END SISWA ===================== --}}

            {{-- ==================== PELATIH ===================== --}}
            @if (auth()->user()->role == 2)
            <li class="nav-item {{Request::is('biodata_pelatih') ? 'active' : ''}} ">
                <a class="nav-link" href="/biodata_pelatih">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Biodata Pelatih</span></a>
            </li>
                
            @endif
            {{-- ==================== END PELATIH ===================== --}}

                        <!-- Nav Item - Pages Collapse Menu -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
