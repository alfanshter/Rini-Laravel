        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                @if (auth()->user()->role ==0)
                <div class="sidebar-brand-text mx-3">Admin</div>                    
                @endif
                @if (auth()->user()->role ==1)
                <div class="sidebar-brand-text mx-3">Siswa</div>                    
                @endif
                @if (auth()->user()->role ==2)
                <div class="sidebar-brand-text mx-3">Pelatih</div>                    
                @endif
                @if (auth()->user()->role ==3)
                <div class="sidebar-brand-text mx-3">Kepala Sekolah</div>                    
                @endif
                @if (auth()->user()->role ==4)
                <div class="sidebar-brand-text mx-3">Wali Kelass</div>                    
                @endif



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

            {{-- <li class="nav-item {{Request::is('kepalasekolah') ? 'active' : ''}} ">
                <a class="nav-link" href="/kepalasekolah">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Data Kepala Sekolah</span></a>
            </li>

            <li class="nav-item {{Request::is('walikelas') ? 'active' : ''}} ">
                <a class="nav-link" href="/walikelas">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Data Wali Kelas</span></a>
            </li> --}}

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

            <li class="nav-item {{Request::is('hasil_seleksi') ? 'active' : ''}}">
                <a class="nav-link" href="/hasil_seleksi">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Hasil Seleksi</span></a>
            </li>

            <li class="nav-item {{Request::is('daftar_agenda') ? 'active' : ''}} ">
                <a class="nav-link" href="/daftar_agenda">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Agenda</span></a>
            </li>


            <li class="nav-item {{Request::is('prestasi') ? 'active' : ''}}"  >
                <a class="nav-link" href="/prestasi">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Prestasi</span></a>
            </li>

            <li class="nav-item {{Request::is('nilai') ? 'active' : ''}}"  >
                <a class="nav-link" href="/nilai">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Nilai</span></a>
            </li>

            <li class="nav-item {{Request::is('pengumuman') ? 'active' : ''}}">
                <a class="nav-link" href="/pengumuman">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Pengumuman</span></a>
            </li>

            <li class="nav-item {{Request::is('absen') ? 'active' : ''}}"  >
                <a class="nav-link" href="/absen">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Absen</span></a>
            </li>     

            <li class="nav-item {{Request::is('absen') ? 'active' : ''}}"  >
                <a class="nav-link" href="/absenpelatih">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Absen Pelatih</span></a>
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

            <li class="nav-item {{Request::is('informasiekskul') ? 'active' : ''}} ">
                <a class="nav-link" href="/informasiekskul">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Informasi Ekskul</span></a>
            </li>

            <li class="nav-item {{Request::is('hasil_seleksi') ? 'active' : ''}} ">
                <a class="nav-link" href="/hasil_seleksi">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Hasil Seleksi</span></a>
            </li>

            <li class="nav-item {{Request::is('daftar_agenda') ? 'active' : ''}} ">
                <a class="nav-link" href="/daftar_agenda">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Agenda</span></a>
            </li>

            <li class="nav-item {{Request::is('prestasi') ? 'active' : ''}}"  >
                <a class="nav-link" href="/prestasi">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Prestasi</span></a>
            </li>

            
            <li class="nav-item {{Request::is('pengumuman') ? 'active' : ''}}"  >
                <a class="nav-link" href="/pengumuman">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Pengumuman</span></a>
            </li>

            <li class="nav-item {{Request::is('nilai') ? 'active' : ''}}"  >
                <a class="nav-link" href="/nilai">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Nilai</span></a>
            </li>

            <li class="nav-item {{Request::is('absen') ? 'active' : ''}}"  >
                <a class="nav-link" href="/absen">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Absen</span></a>
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

            <li class="nav-item {{Request::is('pendaftaran_seleksi') ? 'active' : ''}} ">
                <a class="nav-link" href="/pendaftaran_seleksi">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Pendaftaran Seleksi</span></a>
            </li>

            <li class="nav-item {{Request::is('daftar_ekskul') ? 'active' : ''}} ">
                <a class="nav-link" href="/daftar_ekskul">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Peserta Ekskul</span></a>
            </li>

            <li class="nav-item {{Request::is('daftar_agenda') ? 'active' : ''}} ">
                <a class="nav-link" href="/daftar_agenda">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Agenda</span></a>
            </li>

            
            <li class="nav-item {{Request::is('prestasi') ? 'active' : ''}}"  >
                <a class="nav-link" href="/prestasi">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Prestasi</span></a>
            </li>

            <li class="nav-item {{Request::is('pengumuman') ? 'active' : ''}}"  >
                <a class="nav-link" href="/pengumuman">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Pengumuman</span></a>
            </li>

            <li class="nav-item {{Request::is('nilai') ? 'active' : ''}}"  >
                <a class="nav-link" href="/nilai">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Nilai</span></a>
            </li>
           
            <li class="nav-item {{Request::is('absen') ? 'active' : ''}}"  >
                <a class="nav-link" href="/absen">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Absen</span></a>
            </li>     
 

            @endif
            {{-- ==================== END PELATIH ===================== --}}

            {{-- ==================== KEPALA SEKOLAH ===================== --}}
            @if (auth()->user()->role ==3)
            <li class="nav-item {{Request::is('absen') ? 'active' : ''}}"  >
                <a class="nav-link" href="/absen">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Absen</span></a>
            </li>     

            <li class="nav-item {{Request::is('nilai') ? 'active' : ''}}"  >
                <a class="nav-link" href="/nilai">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Nilai</span></a>
            </li>

            
            <li class="nav-item {{Request::is('daftar_agenda') ? 'active' : ''}} ">
                <a class="nav-link" href="/daftar_agenda">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Agenda</span></a>
            </li>


                
            @endif

            {{-- ==================== END KEPALA SEKOLAH ===================== --}}

            {{-- ==================== WALI KELAS ===================== --}}
            @if ( (auth()->user()->role ==4))
            <li class="nav-item {{Request::is('nilai') ? 'active' : ''}}"  >
                <a class="nav-link" href="/nilai">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Nilai</span></a>
            </li>
                
            @endif

            {{-- ==================== END WALI KELAS ===================== --}}


                        <!-- Nav Item - Pages Collapse Menu -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
