        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <center>
            <img src="{{asset('logo/logosidebar.png')}}" width="100" height="100" alt="" srcset="">
                
            </center>        

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
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
                <div class="sidebar-brand-text mx-3">Wali Kelas</div>                    
                @endif



            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

         

            <!-- Nav Item - Pages Collapse Menu -->
            {{-- ==================== ADMIN ===================== --}}
            @if (auth()->user()->role==0 )

            <li class="nav-item {{Request::is('/') ? 'active' : ''}} ">
                <a class="nav-link" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                      </svg>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item {{Request::is('dataekskul') ? 'active' : ''}} {{Request::is('informasiekskul') ? 'active' : ''}}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa fa-address-book"></i>
                    <span>Data User</span>
                </a>
                <div id="user" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu User:</h6>
                        <a class="collapse-item" href="/datasiswa">Data Siswa</a>
                        <a class="collapse-item" href="/pelatih">Data Pelatih</a>
                        <a class="collapse-item" href="/kepalasekolah">Data Kepala Sekolah</a>
                        <a class="collapse-item" href="/walikelas">Data Wali Kelas</a>
                    </div>
                </div>
            </li>

            {{-- <li class="nav-item {{Request::is('datasiswa') ? 'active' : ''}} ">
                <a class="nav-link" href="/datasiswa">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Data Siswa</span></a>
            </li>

            <li class="nav-item {{Request::is('pelatih') ? 'active' : ''}} ">
                <a class="nav-link" href="/pelatih">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Data Pelatih</span></a>
            </li>
 --}}
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
                    <i class="fas fa-basketball-ball"></i>
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

            <li class="nav-item {{Request::is('peserta') ? 'active' : ''}}">
                <a class="nav-link" href="/peserta">
                    <i class="fa fa-address-book"></i>
                    <span>Daftar Peserta</span></a>
            </li>

            <li class="nav-item {{Request::is('daftar_agenda') ? 'active' : ''}} ">
                <a class="nav-link" href="/daftar_agenda">
                    <i class="fas fa-calendar-check"></i>
                    <span>Agenda</span></a>
            </li>


            <li class="nav-item {{Request::is('prestasi') ? 'active' : ''}}"  >
                <a class="nav-link" href="/prestasi">
                    <i class="fas fa-trophy"></i>
                    <span>Prestasi</span></a>
            </li>

            <li class="nav-item {{Request::is('nilai') ? 'active' : ''}}"  >
                <a class="nav-link" href="/nilai">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Nilai</span></a>
            </li>

            <li class="nav-item {{Request::is('pengumuman') ? 'active' : ''}}">
                <a class="nav-link" href="/pengumuman">
                    <i class="fas fa-bullhorn"></i>
                    <span>Pengumuman</span></a>
            </li>

            <li class="nav-item {{Request::is('absen') ? 'active' : ''}}"  >
                <a class="nav-link" href="/absen">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Absen Siswa</span></a>
            </li>     

            {{-- <li class="nav-item {{Request::is('absenpelatih') ? 'active' : ''}}"  >
                <a class="nav-link" href="/absenpelatih">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Absen Pelatih</span></a>
            </li>      --}}
            @endif
            {{-- ==================== END ADMIN ===================== --}}

            {{-- ==================== SISWA ===================== --}}
            @if (auth()->user()->role == 1)
            <li class="nav-item {{Request::is('/') ? 'active' : ''}} ">
                <a class="nav-link" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                      </svg>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item {{Request::is('biodata') ? 'active' : ''}} ">
                <a class="nav-link" href="/biodata">
                    <i class="fa-solid fa-user"></i>
                    <span>Biodata Siswa</span></a>
            </li>

            <li class="nav-item {{Request::is('informasiekskul') ? 'active' : ''}} ">
                <a class="nav-link" href="/informasiekskul">
                    <i class="fas fa-basketball-ball"></i>
                    <span>Informasi Ekskul</span></a>
            </li>

            <li class="nav-item {{Request::is('hasil_seleksi') ? 'active' : ''}} ">
                <a class="nav-link" href="/hasil_seleksi">
                    <i class="fas fa-tasks"></i>
                    <span>Hasil Seleksi</span></a>
            </li>

            <li class="nav-item {{Request::is('daftar_agenda') ? 'active' : ''}} ">
                <a class="nav-link" href="/daftar_agenda">
                    <i class="fas fa-calendar-check"></i>
                    <span>Agenda</span></a>
            </li>

            <li class="nav-item {{Request::is('prestasi') ? 'active' : ''}}"  >
                <a class="nav-link" href="/prestasi">
                    <i class="fas fa-trophy"></i>
                    <span>Prestasi</span></a>
            </li>

            
            <li class="nav-item {{Request::is('pengumuman') ? 'active' : ''}}"  >
                <a class="nav-link" href="/pengumuman">
                    <i class="fas fa-bullhorn"></i>
                    <span>Pengumuman</span></a>
            </li>

            <li class="nav-item {{Request::is('nilai') ? 'active' : ''}}"  >
                <a class="nav-link" href="/nilai">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Nilai</span></a>
            </li>

            <li class="nav-item {{Request::is('absen') ? 'active' : ''}}"  >
                <a class="nav-link" href="/absen">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Absen</span></a>
            </li>     



            @endif
            {{-- ==================== END SISWA ===================== --}}

            {{-- ==================== PELATIH ===================== --}}
            @if (auth()->user()->role == 2)

            <li class="nav-item {{Request::is('/') ? 'active' : ''}} ">
                <a class="nav-link" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                      </svg>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item {{Request::is('biodata_pelatih') ? 'active' : ''}} ">
                <a class="nav-link" href="/biodata_pelatih">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Biodata Pelatih</span></a>
            </li>

            <li class="nav-item {{Request::is('pendaftaran_seleksi') ? 'active' : ''}} ">
                <a class="nav-link" href="/pendaftaran_seleksi">
                     <i class="fas fa-tasks"></i>
                    <span>Pendaftaran Seleksi</span></a>
            </li>

            <li class="nav-item {{Request::is('daftar_ekskul') ? 'active' : ''}} ">
                <a class="nav-link" href="/daftar_peserta">
                    <i class="fa fa-address-book"></i>
                    <span>Peserta Ekskul</span></a>
            </li>

            <li class="nav-item {{Request::is('daftar_agenda') ? 'active' : ''}} ">
                <a class="nav-link" href="/daftar_agenda">
                    <i class="fas fa-calendar-check"></i>
                    <span>Agenda</span></a>
            </li>

            
            <li class="nav-item {{Request::is('prestasi') ? 'active' : ''}}"  >
                <a class="nav-link" href="/prestasi">
                    <i class="fas fa-trophy"></i>
                    <span>Prestasi</span></a>
            </li>

            <li class="nav-item {{Request::is('pengumuman') ? 'active' : ''}}"  >
                <a class="nav-link" href="/pengumuman">
                    <i class="fas fa-bullhorn"></i>
                    <span>Pengumuman</span></a>
            </li>

            <li class="nav-item {{Request::is('nilai') ? 'active' : ''}}"  >
                <a class="nav-link" href="/nilai">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Nilai</span></a>
            </li>
           
            <li class="nav-item {{Request::is('absen') ? 'active' : ''}}"  >
                <a class="nav-link" href="/absen">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Absen</span></a>
            </li>     

            {{-- <li class="nav-item {{Request::is('absenpelatih') ? 'active' : ''}}"  >
                <a class="nav-link" href="/absenpelatih">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Absen Pelatih</span></a>
            </li>      --}}
 

            @endif
            {{-- ==================== END PELATIH ===================== --}}

            {{-- ==================== KEPALA SEKOLAH ===================== --}}
            @if (auth()->user()->role ==3)

              <li class="nav-item {{Request::is('/') ? 'active' : ''}}"  >
                <a class="nav-link" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                      </svg>
                    <span>Dashboard</span></a>
            </li>     

            <li class="nav-item {{Request::is('editkepalasekolah') ? 'active' : ''}}"  >
                <a class="nav-link" href="/kepalasekolah/editkepalasekolah/{{auth()->user()->id}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Biodata</span></a>
            </li>

            <li class="nav-item {{Request::is('absen') ? 'active' : ''}}"  >
                <a class="nav-link" href="/absen">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Absen</span></a>
            </li>     

            <li class="nav-item {{Request::is('nilai') ? 'active' : ''}}"  >
                <a class="nav-link" href="/nilai">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Nilai</span></a>
            </li>

            
            <li class="nav-item {{Request::is('daftar_agenda') ? 'active' : ''}} ">
                <a class="nav-link" href="/daftar_agenda">
                    <i class="fas fa-calendar-check"></i>
                    <span>Agenda</span></a>
            </li>



                
            @endif

            {{-- ==================== END KEPALA SEKOLAH ===================== --}}

            {{-- ==================== WALI KELAS ===================== --}}
            @if ( (auth()->user()->role ==4))
              <li class="nav-item {{Request::is('/') ? 'active' : ''}}"  >
                <a class="nav-link" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                      </svg>
                    <span>Dashboard</span></a>
            </li>    

            <li class="nav-item {{Request::is('editwalikelas') ? 'active' : ''}}"  >
                <a class="nav-link" href="/walikelas/editwalikelas/{{auth()->user()->id}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Biodata</span></a>
            </li>

            <li class="nav-item {{Request::is('nilai') ? 'active' : ''}}"  >
                <a class="nav-link" href="/nilai">
                    <i class="fas fa-graduation-cap"></i>
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
