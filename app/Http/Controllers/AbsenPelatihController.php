<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\AbsenPelatih;
use App\Models\Ekskul;
use App\Models\InformasiEkskul;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

class AbsenPelatihController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 0) {
            $ekskul = InformasiEkskul::join('data_ekskuls', 'data_ekskuls.kode', '=', 'informasi_ekskuls.id_data_ekskul')
                ->get();
            return view('absenpelatih.daftarabsenpelatih', ['ekskul' => $ekskul]);
        }

        if (auth()->user()->role == 2) {
            $ekskul = InformasiEkskul::join('data_ekskuls', 'data_ekskuls.kode', '=', 'informasi_ekskuls.id_data_ekskul')
                ->where('informasi_ekskuls.kode_pelatih', auth()->user()->nomor_induk)
                ->get();

            return view('absenpelatih.daftarabsenpelatih', ['ekskul' => $ekskul]);
        }
    }

    public function daftar_absenpelatih($nama_ekskul)
    {
        if (auth()->user()->role == 0) {
            //idpelatih
            $namapelatih = DB::table('data_ekskuls')
                ->select(['ekskuls.kode_pelatih as kode_pelatih', 'users.name as nama_pelatih', 'users.id as user_id'])
                ->join('ekskuls', 'ekskuls.id_data_ekskul', '=', 'data_ekskuls.kode')
                ->join('users', 'users.nomor_induk', '=', 'ekskuls.kode_pelatih')
                ->where('data_ekskuls.nama', $nama_ekskul)
                ->first();

            $datapelatih = User::where('id', $namapelatih->user_id)->first();

            if ($namapelatih == null) {
                return redirect('/absen')->with('success', 'Peserta tidak ada');
            }

            return view(
                'absenpelatih.absenpelatih',
                [
                    'namapelatih' => $namapelatih,
                    'nama_ekskul' => $nama_ekskul,
                    'data_pelatih' => $datapelatih
                ]
            );
        } else if (auth()->user()->role == 2) {
            $datapelatih = User::where('id', auth()->user()->id)->first();

            return view(
                'absenpelatih.absenpelatih',
                [
                    'nama_ekskul' => $nama_ekskul,
                    'data_pelatih' => $datapelatih
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

            $validatedData['id_data_ekskul'] = $getekskul->kode;
            $validatedData['bulan'] = $bulan;


            AbsenPelatih::create($validatedData);

            return redirect("/data_absenpelatih/$request->nama_ekskul")->with('success', 'Nilai berhasil di input');
        }
    }


    public function edit($id)
    {
        $absen = AbsenPelatih::select(['users.name', 'absen_pelatihs.*'])
            ->join('users', 'users.id', '=', 'absen_pelatihs.user_id')
            ->where('absen_pelatihs.id', $id)->first();
        return view('absenpelatih.edit_absenpelatih', ['absen' => $absen]);
    }

    public function cetakpdf_absenpelatih(Request $request)
    {
        $nama_ekskul = $request->input('nama_ekskul');
        //idpelatih
        //idpelatih
        $namapelatih = DB::table('data_ekskuls')
            ->select(['ekskuls.kode_pelatih as kode_pelatih', 'users.name as nama_pelatih', 'users.id as user_id'])
            ->join('ekskuls', 'ekskuls.id_data_ekskul', '=', 'data_ekskuls.kode')
            ->join('users', 'users.nomor_induk', '=', 'ekskuls.kode_pelatih')
            ->where('data_ekskuls.nama', $nama_ekskul)
            ->first();

        $datapelatih = User::where('id', $namapelatih->user_id)->first();
        $pdf = Pdf::loadview('absenpelatih.absenpelatih_cetakpdf', [
            'datapelatih' => $datapelatih,
            'nama_ekskul' => $nama_ekskul,
            'namapelatih' => $namapelatih->nama_pelatih,
            'tahun_ajaran' => $request->input('tahun_ajaran'),
            'semester' => $request->input('semester')
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }


    public function update(Request $request)
    {


        $update = DB::table('absen_pelatihs')->where('id', $request->id)->update([
            'absen' => $request->absen
        ]);

        return redirect("/absenpelatih")->with('success', 'Absen berhasil di Edit');
    }

    public function destroy($id)
    {
        AbsenPelatih::destroy($id);
        return redirect('/absenpelatih')->with('success', 'Absen berhasil di hapus ');
    }
}
