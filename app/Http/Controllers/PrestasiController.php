<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Http\Requests\StorePrestasiRequest;
use App\Http\Requests\UpdatePrestasiRequest;
use App\Models\Agenda;
use App\Models\Ekskul;
use App\Models\InformasiEkskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 0) {
            $ekskul = InformasiEkskul::join('data_ekskuls', 'data_ekskuls.kode', '=', 'informasi_ekskuls.id_data_ekskul')
                ->get();
            return view('prestasi.prestasi', ['prestasi' => $ekskul]);
        } else if (auth()->user()->role == 1) {
            // $ekskul = DB::table('ekskuls')
            //     ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.id_data_ekskul')
            //     ->where('is_status', 2)
            //     ->get();

            $ekskul = InformasiEkskul::join('data_ekskuls', 'data_ekskuls.kode', '=', 'informasi_ekskuls.id_data_ekskul')
            ->get();

            return view('prestasi.prestasi', ['prestasi' => $ekskul]);
        } else if (auth()->user()->role == 2) {
            //nama ekskul
            $ekskul = InformasiEkskul::where('kode_pelatih', auth()->user()->nomor_induk)->first();
            //nama peserta
            $nama_peserta = Ekskul::join('users', 'users.nomor_induk', '=', 'ekskuls.nomor_induk_siswa')
                ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.id_data_ekskul')
                ->where('data_ekskuls.kode', $ekskul->id_data_ekskul)
                ->where('kode_pelatih', auth()->user()->nomor_induk)
                ->where('is_status', 2)
                ->get(['users.name', 'data_ekskuls.kode', 'users.nomor_induk']);


            $data_prestasi = Prestasi::where('kode_pelatih', auth()->user()->nomor_induk)
                ->where('id_data_ekskul', $ekskul->id_data_ekskul)
                ->get();

            return view('prestasi.daftar_prestasi', [
                'dataprestasi' => $data_prestasi,
                'nama_peserta' => $nama_peserta,
                'id_data_ekskul' => $ekskul->id_data_ekskul
            ]);
        }
    }

    public function daftar_prestasi($nama)
    {
        if (auth()->user()->role == 2) {
            //nama peserta
            $nama_peserta = Ekskul::join('users', 'users.nomor_induk', '=', 'ekskuls.nomor_induk_siswa')
                ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.id_data_ekskul')
                ->where('data_ekskuls.kode', $nama)
                ->where('kode_pelatih', auth()->user()->nomor_induk)
                ->where('is_status', 2)
                ->get(['users.name', 'data_ekskuls.kode', 'users.nomor_induk']);


            $data_prestasi = Prestasi::where('kode_pelatih', auth()->user()->nomor_induk)
                ->where('id_data_ekskul', $nama)
                ->get();

            return view('prestasi.daftar_prestasi', [
                'dataprestasi' => $data_prestasi,
                'nama_peserta' => $nama_peserta,
                'id_data_ekskul' => $nama
            ]);
        } else if (auth()->user()->role == 1) {
            $data_prestasi = Prestasi::where('id_data_ekskul', $nama)->get();
            return view('prestasi.daftar_prestasi', [
                'dataprestasi' => $data_prestasi
            ]);
        } else if (auth()->user()->role == 0) {
            //idpelatih
            $namapelatih = DB::table('data_ekskuls')
                ->select(['ekskuls.kode_pelatih as kode_pelatih', 'users.nomor_induk as nama_pelatih'])
                ->join('ekskuls', 'ekskuls.id_data_ekskul', '=', 'data_ekskuls.kode')
                ->join('users', 'users.nomor_induk', '=', 'ekskuls.kode_pelatih')
                ->where('data_ekskuls.kode', $nama)
                ->first();

            if ($namapelatih == null) {
                return redirect('/prestasi')->with('success', 'Belum ada peserta');
            } else {
                //nama peserta
                $nama_peserta = Ekskul::join('users', 'users.nomor_induk', '=', 'ekskuls.nomor_induk_siswa')
                    ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.id_data_ekskul')
                    ->where('data_ekskuls.kode', $nama)
                    ->where('data_ekskuls.kode', $nama)
                    ->where('is_status', 2)
                    ->get(['users.name', 'data_ekskuls.kode', 'users.nomor_induk']);

                $data_prestasi = Prestasi::where('id_data_ekskul', $nama)
                    ->get();

                return view('prestasi.daftar_prestasi', [
                    'dataprestasi' => $data_prestasi,
                    'id_data_ekskul' => $nama,
                    'nama_peserta' => $nama_peserta,
                    'pelatih' => $namapelatih
                ]);
            }
        }
    }

    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'nomor_induk' => 'required|max:255',
            'nama_lomba' => ['required'],
            'id_data_ekskul' => ['required'],
            'prestasi' => ['required'],
            'nama_pelatih' => ['required'],
            'kode_pelatih' => ['required'],
            'tanggal' => ['required'],
            'foto' => 'image|file|max:1024'
        ]);

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto-prestasi');
        }

        Prestasi::create($validatedData);

        return redirect("/daftar_prestasi/$request->id_data_ekskul")->with('success', 'Prestasi berhasil di input');
    }

    public function edit($id)
    {
        $data_prestasi = Prestasi::where('id', $id)->first();
        $data_agenda = Agenda::where('id', $id)->first();
        return view('prestasi.edit_prestasi', ['data_prestasi' => $data_prestasi]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lomba' => 'required',
            'foto' => 'image|file|max:1024',
            'prestasi' => 'required',
            'tanggal' => 'required'
        ]);



        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['foto'] = $request->file('foto')->store('foto-prestasi');
        }

        Prestasi::where('id', $request->id)->update($validatedData);

        return redirect("/daftar_prestasi/$request->id_data_ekskul")->with('success', 'Update data berhasil');
    }

    public function destroy(Request $request)
    {
        $delete = Prestasi::where('id', $request->id)->delete();
        Storage::delete($request->foto);
        return redirect(url()->previous())->with('success', 'Prestasi berhasil di hapus ');
    }
}
