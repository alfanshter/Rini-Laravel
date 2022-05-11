<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Http\Requests\StoreEkskulRequest;
use App\Http\Requests\UpdateEkskulRequest;
use App\Models\DataEkskul;
use App\Models\InformasiEkskul;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class EkskulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function pendaftaran_seleksi()
    {
        $pendaftaran_seleksi = Ekskul::join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
            ->join('informasi_ekskuls', 'informasi_ekskuls.id', '=', 'ekskuls.id_informasi')
            ->join('users', 'users.nim', '=', 'ekskuls.nim_siswa')
            ->where('ekskuls.kode_pelatih', auth()->user()->nim)
            ->where('ekskuls.is_status', 1)
            ->get(['users.name', 'users.kelas', 'users.jenis_kelamin', 'informasi_ekskuls.*', 'data_ekskuls.nama as nama_ekskul', 'ekskuls.*']);
        return view('ekskul.pendaftaran_seleksi', [
            'pendaftaran_seleksi' => $pendaftaran_seleksi
        ]);
    }

    public function register($id)
    {
        $data = DataEkskul::join('informasi_ekskuls', 'informasi_ekskuls.kode_ekskul', '=', 'data_ekskuls.kode')
            ->join('users', 'users.nim', '=', 'informasi_ekskuls.kode_pelatih')
            ->where('informasi_ekskuls.id', $id)
            ->first(['data_ekskuls.nama', 'informasi_ekskuls.*', 'users.name', 'users.nim']);

        $is_daftar = 0;
        $cekpendaftaran = Ekskul::where('nim_siswa', auth()->user()->nim)->where('id_informasi', $id)->first();
        if ($cekpendaftaran != null) {
            $is_daftar = $cekpendaftaran->is_status;
        }
        return view('ekskul.pendaftaran', [
            'data_ekskul' => $data,
            'is_daftar' => $is_daftar
        ]);
    }

    public function store(Request $request)
    {
        Ekskul::create($request->all());
        return redirect('/ekskul/pendaftaran/' . +$request->id_informasi)->with('success', 'Pendaftaran berhasil');
    }

    public function update(Request $request)
    {
        $status = $request->is_status;
        $update = DB::table('ekskuls')->where('id', $request->id)->update([
            'is_status' => $request->is_status
        ]);

        if ($status == 2) {
            return redirect('/pendaftaran_seleksi')->with('success', 'Pendaftar diterima');
        } else if ($status == 3) {
            return redirect('/pendaftaran_seleksi')->with('success', 'Pendaftar ditolak');
        }
    }

    public function daftar_ekskul()
    {

        $ekskul = InformasiEkskul::join('data_ekskuls', 'data_ekskuls.kode', '=', 'informasi_ekskuls.kode_ekskul')
            ->where('informasi_ekskuls.kode_pelatih', auth()->user()->nim)
            ->get();

        return view('ekskul.daftar_ekskul', ['ekskul' => $ekskul]);
    }

    public function daftar_peserta()
    {
        //nama ekskul
        $nama_ekskul = InformasiEkskul::where('kode_pelatih', auth()->user()->nim)->first();

        $getpeserta = Ekskul::join('users', 'users.nim', '=', 'ekskuls.nim_siswa')
            ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
            ->where('kode_ekskul', $nama_ekskul->kode_ekskul)
            ->where('kode_pelatih', auth()->user()->nim)
            ->where('is_status', 2)
            ->get(['users.name', 'users.kelas', 'users.nim', 'users.jenis_kelamin', 'data_ekskuls.nama', 'data_ekskuls.kode', 'ekskuls.id']);

        return view('ekskul.daftar_peserta', ['peserta' => $getpeserta, 'kode_ekskul' => $nama_ekskul->kode_ekskul]);
    }

    public function peserta_cetakpdf(Request $request)
    {
        $getpeserta = Ekskul::join('users', 'users.nim', '=', 'ekskuls.nim_siswa')
            ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
            ->where('kode_ekskul', $request->kode)
            ->where('kode_pelatih', auth()->user()->nim)
            ->where('is_status', 2)
            ->get(['users.name', 'users.kelas', 'users.nim', 'data_ekskuls.nama', 'data_ekskuls.kode', 'ekskuls.id']);

        $pdf = PDF::loadview('ekskul.peserta_cetakpdf', [
            'peserta' => $getpeserta
        ]);
        return $pdf->stream();
    }

    public function delete_peserta(Request $request)
    {
        $delete = Ekskul::where('id', $request->id)->delete();

        return redirect('/daftar_peserta/' . $request->kode)->with('success', 'Peserta dihapus');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function daftar_seleksi()
    {
        if (auth()->user()->role == 0) {
            $ekskul = InformasiEkskul::join('data_ekskuls', 'data_ekskuls.kode', '=', 'informasi_ekskuls.kode_ekskul')
                ->get();
            return view('hasilseleksi.daftar_seleksi', ['seleksi' => $ekskul]);
        }
    }
    public function hasil_seleksi($id)
    {
        if (auth()->user()->role == 1) {
            $hasil_seleksi =  Ekskul::join('users', 'users.nim', '=', 'ekskuls.nim_siswa')
                ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
                ->where('nim_siswa', auth()->user()->nim)
                ->get(['users.*', 'ekskuls.*', 'data_ekskuls.nama']);

            return view('hasilseleksi.hasilseleksi', ['hasil_seleksi' => $hasil_seleksi]);
        } else if (auth()->user()->role == 0) {
            $hasil_seleksi =  Ekskul::join('users', 'users.nim', '=', 'ekskuls.nim_siswa')
                ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
                ->where('kode_ekskul', $id)
                ->get(['users.*', 'ekskuls.*', 'data_ekskuls.nama']);

            return view('hasilseleksi.hasilseleksi', ['hasil_seleksi' => $hasil_seleksi]);
        }
    }

    public function hasil_seleksi_siswa()
    {
        $hasil_seleksi =  Ekskul::join('users', 'users.nim', '=', 'ekskuls.nim_siswa')
            ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
            ->where('nim_siswa', auth()->user()->nim)
            ->get(['users.*', 'ekskuls.*', 'data_ekskuls.nama']);

        return view('hasilseleksi.hasilseleksi', ['hasil_seleksi' => $hasil_seleksi]);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEkskulRequest  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function show(Ekskul $ekskul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function edit(Ekskul $ekskul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEkskulRequest  $request
     * @param  \App\Models\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ekskul $ekskul)
    {
        //
    }
}
