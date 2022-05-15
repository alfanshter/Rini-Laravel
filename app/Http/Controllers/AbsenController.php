<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\DataEkskul;
use App\Models\Ekskul;
use App\Models\InformasiEkskul;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AbsenController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 0) {
            $ekskul = InformasiEkskul::join('data_ekskuls', 'data_ekskuls.kode', '=', 'informasi_ekskuls.kode_ekskul')
                ->get();
            return view('absen.daftarabsen', ['ekskul' => $ekskul]);
        } else if (auth()->user()->role == 2) {

            //nama ekskul
            $ekskul = InformasiEkskul::where('kode_pelatih', auth()->user()->nomor_induk)->first();
            //nama siswa
            $nama_siswa = Ekskul::join('users', 'users.nomor_induk', '=', 'ekskuls.nomor_induk_siswa')
                ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
                ->where('data_ekskuls.kode', $ekskul->kode_ekskul)
                ->where('kode_pelatih', auth()->user()->nomor_induk)
                ->where('is_status', 2)
                ->get(['users.name', 'users.nomor_induk', 'users.id']);

            $absen = DB::table('absens')
                ->select(['absens.*', 'users.kelas', 'users.name'])
                ->join('users', 'users.id', '=', 'absens.user_id')
                ->where('id_pelatih', auth()->user()->nomor_induk)
                ->where('id_ekskul', $ekskul->kode_ekskul)
                ->get();


            return view(
                'absen.absen',
                [
                    'absen' => $absen,
                    'nama_siswa' => $nama_siswa,
                    'nama_ekskul' => $ekskul->kode_ekskul
                ]
            );
            //$ekskul = InformasiEkskul::join('data_ekskuls', 'data_ekskuls.kode', '=', 'informasi_ekskuls.kode_ekskul')
            //    ->where('informasi_ekskuls.kode_pelatih', auth()->user()->nomor_induk)
            //    ->get();

            //return view('absen.daftarabsen', ['ekskul' => $ekskul]);
        } else if (auth()->user()->role == 1) {
            $ekskul = DB::table('ekskuls')
                ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
                ->where('nomor_induk_siswa', auth()->user()->nomor_induk)
                ->where('is_status', 2)
                ->get();

            return view('absen.daftarabsen', ['ekskul' => $ekskul]);
        } else if (auth()->user()->role == 3) {
            $ekskul = InformasiEkskul::join('data_ekskuls', 'data_ekskuls.kode', '=', 'informasi_ekskuls.kode_ekskul')
                ->get();
            return view('absen.daftarabsen', ['ekskul' => $ekskul]);
        }
    }

    public function daftar_absen($nama_ekskul)
    {
        if (auth()->user()->role == 0) {
            //idpelatih
            $namapelatih = DB::table('data_ekskuls')
                ->select(['ekskuls.kode_pelatih as id_pelatih', 'users.name as nama_pelatih'])
                ->join('ekskuls', 'ekskuls.kode_ekskul', '=', 'data_ekskuls.kode')
                ->join('users', 'users.nomor_induk', '=', 'ekskuls.kode_pelatih')
                ->where('data_ekskuls.kode', $nama_ekskul)
                ->first();
            if ($namapelatih == null) {
                return redirect('/absen')->with('success', 'Peserta tidak ada');
            }

            //nama siswa
            $nama_siswa = Ekskul::join('users', 'users.nomor_induk', '=', 'ekskuls.nomor_induk_siswa')
                ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
                ->where('data_ekskuls.kode', $nama_ekskul)
                ->where('is_status', 2)
                ->get(['users.name', 'users.kelas', 'users.nomor_induk', 'users.id']);




            $absen = DB::table('absens')
                ->select(['absens.*', 'users.kelas', 'users.name'])
                ->join('users', 'users.id', '=', 'absens.user_id')
                ->where('id_pelatih', $namapelatih->id_pelatih)
                ->where('nama_ekskul', $nama_ekskul)
                ->get();


            return view(
                'absen.absen',
                [
                    'absen' => $absen,
                    'nama_siswa' => $nama_siswa,
                    'namapelatih' => $namapelatih,
                    'nama_ekskul' => $nama_ekskul
                ]
            );
        } else if (auth()->user()->role == 2) {
            //nama siswa
            $nama_siswa = Ekskul::join('users', 'users.nomor_induk', '=', 'ekskuls.nomor_induk_siswa')
                ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
                ->where('data_ekskuls.nama', $nama_ekskul)
                ->where('kode_pelatih', auth()->user()->nomor_induk)
                ->where('is_status', 2)
                ->get(['users.name', 'users.nomor_induk', 'users.id']);

            $absen = DB::table('absens')
                ->select(['absens.*', 'users.kelas', 'users.name'])
                ->join('users', 'users.id', '=', 'absens.user_id')
                ->where('id_pelatih', auth()->user()->nomor_induk)
                ->where('nama_ekskul', $nama_ekskul)
                ->get();


            return view(
                'absen.absen',
                [
                    'absen' => $absen,
                    'nama_siswa' => $nama_siswa,
                    'nama_ekskul' => $nama_ekskul
                ]
            );
        } else if (auth()->user()->role == 1) {

            $absen = DB::table('absens')
                ->where('user_id', auth()->user()->id)
                ->where('nama_ekskul', $nama_ekskul)
                ->get();

            return view(
                'absen.absen',
                [
                    'absen' => $absen,
                    'nama_ekskul' => $nama_ekskul
                ]
            );
        }

        if (auth()->user()->role == 3) {
            //idpelatih
            //idpelatih
            $namapelatih = DB::table('data_ekskuls')
                ->select(['ekskuls.kode_pelatih as id_pelatih', 'users.name as nama_pelatih'])
                ->join('ekskuls', 'ekskuls.kode_ekskul', '=', 'data_ekskuls.kode')
                ->join('users', 'users.nomor_induk', '=', 'ekskuls.kode_pelatih')
                ->where('data_ekskuls.kode', $nama_ekskul)
                ->first();
            if ($namapelatih == null) {
                return redirect('/absen')->with('success', 'Peserta tidak ada');
            }

            if ($namapelatih == null) {
                return redirect('/absen')->with('success', 'Belum ada peserta');
            }

            //nama siswa
            $nama_siswa = Ekskul::join('users', 'users.nomor_induk', '=', 'ekskuls.nomor_induk_siswa')
                ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
                ->where('data_ekskuls.nama', $nama_ekskul)
                ->where('data_ekskuls.nama', $nama_ekskul)
                ->where('is_status', 2)
                ->get(['users.name', 'users.kelas', 'users.nomor_induk']);

            $absen = DB::table('absens')
                ->select(['absens.*', 'users.kelas', 'users.name'])
                ->join('users', 'users.id', '=', 'absens.user_id')
                ->where('id_pelatih', $namapelatih->id_pelatih)
                ->where('nama_ekskul', $nama_ekskul)
                ->get();


            return view(
                'absen.absen',
                [
                    'absen' => $absen,
                    'nama_siswa' => $nama_siswa,
                    'namapelatih' => $namapelatih,
                    'nama_ekskul' => $nama_ekskul
                ]
            );
        }
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama_ekskul' => 'required|max:255',
            'user_id' => ['required'],
            'absen' => ['required'],
            'tanggal' => ['required'],
            'tahun_ajaran' => ['required'],
            'semester' => ['required']
        ]);



        $bulan = Carbon::parse($request->tanggal)->isoFormat('MMMM');
        if (auth()->user()->role == 0) {
            //getid ekskul
            $getekskul = DB::table('data_ekskuls')
                ->where('nama', $request->nama_ekskul)
                ->first();

            //Nama Siswa
            $siswa = DB::table('users')
                ->where('id', $request->user_id)
                ->first();

            //Nama Pelatih
            $namapelatih = DB::table('data_ekskuls')
                ->select(['ekskuls.kode_pelatih as id_pelatih', 'users.name as nama_pelatih', 'ekskuls.kode_ekskul'])
                ->join('ekskuls', 'ekskuls.kode_ekskul', '=', 'data_ekskuls.kode')
                ->join('users', 'users.nomor_induk', '=', 'ekskuls.kode_pelatih')
                ->where('data_ekskuls.kode', $request->nama_ekskul)
                ->first();


            $validatedData['nama_pelatih'] = $namapelatih->nama_pelatih;
            $validatedData['id_pelatih'] = $namapelatih->id_pelatih;
            $validatedData['id_ekskul'] = $namapelatih->kode_ekskul;
            $validatedData['nama_siswa'] = $siswa->name;
            $validatedData['bulan'] = $bulan;


            Absen::create($validatedData);

            return redirect("/data_absen/$request->nama_ekskul")->with('success', 'absensi berhasil di input');
        } else if (auth()->user()->role == 2) {
            //getid ekskul
            //Nama Pelatih
            $namapelatih = DB::table('data_ekskuls')
                ->select(['ekskuls.kode_pelatih as id_pelatih', 'users.name as nama_pelatih', 'ekskuls.kode_ekskul'])
                ->join('ekskuls', 'ekskuls.kode_ekskul', '=', 'data_ekskuls.kode')
                ->join('users', 'users.nomor_induk', '=', 'ekskuls.kode_pelatih')
                ->where('data_ekskuls.kode', $request->nama_ekskul)
                ->first();


            //Nama Siswa
            $siswa = DB::table('users')
                ->where('id', $request->user_id)
                ->first();


            $validatedData['nama_pelatih'] = auth()->user()->name;
            $validatedData['id_pelatih'] = auth()->user()->nomor_induk;
            $validatedData['id_ekskul'] = $namapelatih->kode_ekskul;
            $validatedData['nama_siswa'] = $siswa->name;
            $validatedData['bulan'] = $bulan;

            Absen::create($validatedData);

            return redirect("/absen")->with('success', 'Absen berhasil di input');
        }
    }

    public function destroy($id)
    {

        Absen::destroy($id);
        if (auth()->user()->role == 2) {
            return redirect("/absen")->with('success', 'Absen berhasil di hapus');
        }

        return redirect(url()->previous())->with('success', 'Absen berhasil di hapus ');
    }


    public function edit($id)
    {
        $absen = Absen::where('id', $id)->first();;
        return view('absen.edit_absen', ['absen' => $absen]);
    }

    public function update(Request $request)
    {

        $update = DB::table('absens')->where('id', $request->id)->update([
            'absen' => $request->absen,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        if (auth()->user()->role == 2) {
            return redirect("/absen")->with('success', 'Absen berhasil di edit');
        }


        return redirect("/data_absen/$request->nama_ekskul")->with('success', 'absensi berhasil di Edit');
    }

    public function cetakpdf_absen(Request $request)
    {
        $nama_ekskul = $request->input('nama_ekskul');


        //Nama Pelatih
        $namapelatih = DataEkskul::select(['ekskuls.kode_pelatih as id_pelatih', 'users.name as nama_pelatih', 'ekskuls.kode_ekskul', 'data_ekskuls.*'])
            ->join('ekskuls', 'ekskuls.kode_ekskul', '=', 'data_ekskuls.kode')
            ->join('users', 'users.nomor_induk', '=', 'ekskuls.kode_pelatih')
            ->where('data_ekskuls.kode', $request->nama_ekskul)
            ->first();

        $id_ekskul = $namapelatih->kode_ekskul;


        //$users = User::where('role', '1')->with(['absensi' => function ($query) use ($id_ekskul) {
        //    $query->where('id_ekskul', $id_ekskul);
        //}])->get();
        $users = User::where('role', '1')->whereHas('absensi', function ($query) use ($id_ekskul) {
            $query->where('id_ekskul', $id_ekskul);
        })->get();


        $absen = Absen::where('nama_ekskul', $nama_ekskul)
            ->select(['absens.*', 'users.kelas'])
            ->join('users', 'users.id', '=', 'absens.user_id')
            ->get();
        $jumlahabsen = count($absen);

        $nama_siswa = Absen::where('nama_ekskul', $nama_ekskul)
            ->select(['absens.*', 'users.kelas', 'users.id'])
            ->join('users', 'users.id', '=', 'absens.user_id')
            ->groupBy('user_id')
            ->get();

        $pdf = Pdf::loadview('absen.absen_cetakpdf', [
            'absen' => $absen,
            'jumlahabsen' => $jumlahabsen,
            'nama_siswa' => $nama_siswa,
            'users' => $users,
            'tahun_ajaran' => $request->input('tahun_ajaran'),
            'semester' => $request->input('semester'),
            'nama_ekskul' => $nama_ekskul,
            'nama_ekskuls' => $namapelatih->nama,
            'namapelatih' => $namapelatih
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
