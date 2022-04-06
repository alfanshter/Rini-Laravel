<?php

namespace App\Http\Controllers;

use App\Models\InformasiEkskul;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahsiswa = User::where('role',1)->count();
        $jumlahpelatih = User::where('role',2)->count();
        $jumlahadmin = User::where('role',0)->count();
        $jumlahekskul = InformasiEkskul::count();

        return view('dashboard.index',[
            'jumlahsiswa'=> $jumlahsiswa,
            'jumlahpelatih'=> $jumlahpelatih,
            'jumlahadmin'=> $jumlahadmin,
            'jumlahekskul'=> $jumlahekskul
        ]);
    }
}