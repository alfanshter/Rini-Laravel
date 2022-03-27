<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataEkskulController;
use App\Http\Controllers\DataPelatihController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\InformasiEkskulController;
use App\Http\Controllers\KepalaSekolahController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NilaiSiswaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\RegisterController;
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
Route::resource('/dataekskul',DataEkskulController::class)->middleware('auth');
Route::get('/dataekskul/editekskul/{id}', [DataEkskulController::class,'edit'])->middleware('auth');
Route::post('/dataekskul/updateekskul', [DataEkskulController::class,'update'])->middleware('auth');
Route::get('/nilaisiswa', [NilaiSiswaController::class,'index'])->middleware('auth');

//Kepala Sekolah
Route::get('/kepalasekolah', [KepalaSekolahController::class,'index'])->middleware('auth');
Route::post('/kepalasekolah', [KepalaSekolahController::class,'tambahkepalasekolah']);
Route::get('/kepalasekolah/editkepalasekolah/{id}', [KepalaSekolahController::class,'edit'])->middleware('auth');
Route::post('/kepalasekolah/updatekepalasekolah', [KepalaSekolahController::class,'update'])->middleware('auth');
Route::delete('/kepalasekolah/hapuskepalasekolah/{id}', [KepalaSekolahController::class,'destroy'])->middleware('auth');

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
Route::get('/cetakpdf_agenda_pelatih/{nama}', [AgendaController::class,'cetakpdf_agenda_pelatih'])->middleware('auth');

//Prestasi
Route::get('/prestasi', [PrestasiController::class,'index'])->middleware('auth');
