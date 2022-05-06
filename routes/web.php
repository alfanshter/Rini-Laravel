<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AbsenPelatihController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataEkskulController;
use App\Http\Controllers\DataPelatihController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\InformasiEkskulController;
use App\Http\Controllers\KepalaSekolahController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\NilaiSiswaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WaliKelasController;
use App\Models\DataEkskul;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layout.master');
// });
Route::get('/', [DashboardController::class,'index'])->middleware('auth');

Route::get('/login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class,'authenticate']);
Route::post('/logout', [LoginController::class,'logout']);

Route::get('/register', [RegisterController::class,'index'])->middleware('guest');
Route::post('/register', [RegisterController::class,'store']);

Route::get('/datasiswa', [DataSiswaController::class,'index'])->middleware('auth');
Route::post('/tambahsiswa', [DataSiswaController::class,'tambahsiswa']);
Route::get('/biodata', [DataSiswaController::class,'biodata'])->middleware('auth');
Route::post('/datasiswa/updatesiswa', [DataSiswaController::class,'update'])->middleware('auth');
Route::post('/datasiswa/updatepassword', [DataSiswaController::class,'updatepassword'])->middleware('auth');
Route::delete('/datasiswa/hapussiswa/{id}', [DataSiswaController::class,'destroy'])->middleware('auth');
Route::get('/datasiswa/editsiswa/{id}', [DataSiswaController::class,'edit'])->middleware('auth');

// pelatih
Route::get('/pelatih', [DataPelatihController::class,'index'])->middleware('auth');
Route::post('/tambahpelatih', [DataPelatihController::class,'tambahpelatih']);
Route::get('/biodata_pelatih', [DataPelatihController::class,'biodata_pelatih'])->middleware('auth');
Route::get('/datapelatih/editpelatih/{id}', [DataPelatihController::class,'edit'])->middleware('auth');
Route::post('/pelatih/updatepassword', [DataPelatihController::class,'updatepassword'])->middleware('auth');
Route::post('/datapelatih/updatepelatih', [DataPelatihController::class,'update'])->middleware('auth');
Route::delete('/datapelatih/hapuspelatih/{id}', [DataPelatihController::class,'destroy'])->middleware('auth');

//Data Eksul
Route::get('/dataekskul',[DataEkskulController::class,'index'])->middleware('auth');
Route::post('/dataekskul',[DataEkskulController::class,'store'])->middleware('auth');
Route::get('/dataekskul/destroy/{id}',[DataEkskulController::class,'destroy'])->middleware('auth');
Route::get('/dataekskul/editekskul/{id}', [DataEkskulController::class,'edit'])->middleware('auth');
Route::post('/dataekskul/updateekskul', [DataEkskulController::class,'update'])->middleware('auth');
Route::get('/nilaisiswa', [NilaiSiswaController::class,'index'])->middleware('auth');

//Kepala Sekolah
Route::get('/kepalasekolah', [KepalaSekolahController::class,'index'])->middleware('auth');
Route::post('/kepalasekolah', [KepalaSekolahController::class,'tambahkepalasekolah']);
Route::get('/kepalasekolah/editkepalasekolah/{id}', [KepalaSekolahController::class,'edit'])->middleware('auth');
Route::post('/kepalasekolah/updatekepalasekolah', [KepalaSekolahController::class,'update'])->middleware('auth');
Route::delete('/kepalasekolah/hapuskepalasekolah/{id}', [KepalaSekolahController::class,'destroy'])->middleware('auth');

//Wali kelas
Route::get('/walikelas', [WaliKelasController::class,'index'])->middleware('auth');
Route::post('/walikelas', [WaliKelasController::class,'tambahwalikelas']);
Route::get('/walikelas/editwalikelas/{id}', [WaliKelasController::class,'edit'])->middleware('auth');
Route::post('/walikelas/updatewalikelas', [WaliKelasController::class,'update'])->middleware('auth');
Route::delete('/walikelas/hapuswalikelas/{id}', [WaliKelasController::class,'destroy'])->middleware('auth');

//Informasi Ekskul
Route::get('/informasiekskul', [InformasiEkskulController::class,'index'])->middleware('auth');
Route::post('/informasiekskul', [InformasiEkskulController::class,'store'])->middleware('auth');
Route::get('/informasiekskul/editinformasiekskul/{id}', [InformasiEkskulController::class,'edit'])->middleware('auth');
Route::post('/informasiekskul/updateinformasiekskul', [InformasiEkskulController::class,'update'])->middleware('auth');
Route::delete('/informasiekskul/hapusinformasiekskul/{id}', [InformasiEkskulController::class,'destroy'])->middleware('auth');

//Eksul
Route::get('/ekskul/pendaftaran/{id}', [EkskulController::class,'register'])->middleware('auth');
Route::get('/pendaftaran_seleksi', [EkskulController::class,'pendaftaran_seleksi'])->middleware('auth');
Route::get('/hasil_seleksi', [EkskulController::class,'hasil_seleksi'])->middleware('auth');
Route::get('/daftar_ekskul', [EkskulController::class,'daftar_ekskul'])->middleware('auth');
Route::get('/daftar_peserta/{kode_ekskul}', [EkskulController::class,'daftar_peserta'])->middleware('auth');
Route::post('/ekskul/pendaftaran', [EkskulController::class,'store'])->middleware('auth');
Route::post('/delete_peserta', [EkskulController::class,'delete_peserta'])->middleware('auth');
Route::put('/pendaftaran_seleksi/updatestatus', [EkskulController::class,'update'])->middleware('auth');
Route::post('/cetakpdf_peserta', [EkskulController::class,'peserta_cetakpdf'])->middleware('auth');

//Agenda
Route::get('/daftar_agenda/{nama}', [AgendaController::class,'index'])->middleware('auth');
Route::post('/post_agenda', [AgendaController::class,'store'])->middleware('auth');
Route::post('/updateagenda', [AgendaController::class,'updateagenda'])->middleware('auth');
Route::get('/agenda/{id}', [AgendaController::class,'edit'])->middleware('auth');
Route::delete('/agenda/hapusagenda/{id}', [AgendaController::class,'destroy'])->middleware('auth');
Route::get('/daftar_agenda', [AgendaController::class,'daftar_agenda'])->middleware('auth');
Route::get('/cetakpdf_agenda_pelatih/{nama_ekskul?&tahun_ajaran?&semester?}', [AgendaController::class,'cetakpdf_agenda_pelatih'])->middleware('auth');

//Prestasi
Route::get('/prestasi', [PrestasiController::class,'index'])->middleware('auth');
Route::get('/daftar_prestasi/{nama}', [PrestasiController::class,'daftar_prestasi'])->middleware('auth');
Route::post('/prestasi', [PrestasiController::class,'store'])->middleware('auth');
Route::post('/update_prestasi', [PrestasiController::class,'update'])->middleware('auth');
Route::get('/prestasi/{id}', [PrestasiController::class,'edit'])->middleware('auth');
Route::delete('/prestasi/hapusprestasi/{id}', [PrestasiController::class,'destroy'])->middleware('auth');

//Pengumuman
Route::get('/pengumuman', [PengumumanController::class,'index'])->middleware('auth');
Route::get('/pengumuman/{id}', [PengumumanController::class,'edit'])->middleware('auth');
Route::post('/pengumuman', [PengumumanController::class,'store'])->middleware('auth');
Route::post('/pengumuman/update', [PengumumanController::class,'update'])->middleware('auth');
Route::post('/pengumuman/delete', [PengumumanController::class,'delete'])->middleware('auth');

//Nilai
Route::get('/nilai', [NilaiController::class,'index'])->middleware('auth');
Route::get('/nilai/{id}', [NilaiController::class,'edit'])->middleware('auth');
Route::post('/nilai', [NilaiController::class,'store'])->middleware('auth');
Route::get('/data_nilai/{nama_ekskul}', [NilaiController::class,'daftar_nilai'])->middleware('auth');
Route::delete('/hapusnilai/{id}', [NilaiController::class,'destroy'])->middleware('auth');
Route::post('/update_nilai', [NilaiController::class,'update'])->middleware('auth');
Route::get('/cetakpdf_nilai/{nama_ekskul?&tahun_ajaran?&semester?}', [NilaiController::class,'cetakpdf_nilai'])->middleware('auth');

//ABSEN
Route::get('/absen', [AbsenController::class,'index'])->middleware('auth');
Route::get('/absen/{id}', [AbsenController::class,'edit'])->middleware('auth');
Route::post('/absen', [AbsenController::class,'store'])->middleware('auth');
Route::get('/data_absen/{nama_ekskul}', [AbsenController::class,'daftar_absen'])->middleware('auth');
Route::delete('/hapusabsen/{id}', [AbsenController::class,'destroy'])->middleware('auth');
Route::post('/update_absen', [AbsenController::class,'update'])->middleware('auth');
Route::get('/cetakpdf_absen/{nama_ekskul?&tahun_ajaran?&semester?}', [AbsenController::class,'cetakpdf_absen'])->middleware('auth');


//ABSENPelatih
Route::get('/absenpelatih', [AbsenPelatihController::class,'index'])->middleware('auth');
Route::get('/absenpelatih/{id}', [AbsenPelatihController::class,'edit'])->middleware('auth');
Route::get('/data_absenpelatih/{nama_ekskul}', [AbsenPelatihController::class,'daftar_absenpelatih'])->middleware('auth');
Route::post('/absenpelatih', [AbsenPelatihController::class,'store'])->middleware('auth');
Route::get('/cetakpdf_absenpelatih/{user_id?&nama_ekskul?&tahun_ajaran?&semester?}', [AbsenPelatihController::class,'cetakpdf_absenpelatih'])->middleware('auth');
Route::post('/update_absenpelatih', [AbsenPelatihController::class,'update'])->middleware('auth');
Route::delete('/hapusabsenpelatih/{id}', [AbsenPelatihController::class,'destroy'])->middleware('auth');