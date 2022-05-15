<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\InformasiEkskul;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahsiswa = User::where('role', 1)->count();
        $jumlahpelatih = User::where('role', 2)->count();
        $jumlahadmin = User::where('role', 0)->count();
        $jumlahekskul = InformasiEkskul::count();
        $jumlahpengumuman = Pengumuman::count();


        if (auth()->user()->role == 0 || auth()->user()->role == 1) {
            return view('dashboard.index', [
                'jumlahsiswa' => $jumlahsiswa,
                'jumlahpelatih' => $jumlahpelatih,
                'jumlahadmin' => $jumlahadmin,
                'jumlahekskul' => $jumlahekskul,
                'jumlahpengumuman' => $jumlahpengumuman
            ]);
        } else if (auth()->user()->role == 2 || auth()->user()->role == 3 || auth()->user()->role == 4) {

            $jumlah_peserta_ekskul = Ekskul::where('kode_pelatih', auth()->user()->nomor_induk)
                ->where('is_status', 2)->count();

            $jumlah_pendaftar = Ekskul::where('kode_pelatih', auth()->user()->nomor_induk)
                ->where('is_status', 1)->count();
            return view('dashboard.index', [
                'jumlahsiswa' => $jumlahsiswa,
                'jumlahpelatih' => $jumlahpelatih,
                'jumlahadmin' => $jumlahadmin,
                'jumlahekskul' => $jumlahekskul,
                'jumlahpengumuman' => $jumlahpengumuman,
                'jumlah_peserta_ekskul' => $jumlah_peserta_ekskul,
                'jumlah_pendaftar' => $jumlah_pendaftar

            ]);
        }
    }
}
