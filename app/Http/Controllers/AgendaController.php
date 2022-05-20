<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use App\Models\Ekskul;
use App\Models\InformasiEkskul;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{

    public function index($nama)
    {

        if (auth()->user()->role == 1) {
            $uid = auth()->user()->nomor_induk;
            $data_agenda = Agenda::where('nama_ekskul', $nama)
                ->whereHas('ekskul', function ($query) use ($uid) {
                    $query->where('nomor_induk_siswa', $uid);
                    $query->where('is_status', 2);
                })
                ->with('users')
                ->with('data_ekskul')
                ->get();
            return view('agenda.agenda', [
                'dataagenda' => $data_agenda
            ]);
        } else if (auth()->user()->role == 0) {

            //group tahun ajaran
            $tahun_ajaran = Agenda::groupBy('tahun_ajaran')->distinct()->get();
            //idpelatih
            $namapelatih = DB::table('data_ekskuls')
                ->select(['ekskuls.kode_pelatih as kode_pelatih', 'users.nomor_induk as nama_pelatih'])
                ->join('ekskuls', 'ekskuls.id_data_ekskul', '=', 'data_ekskuls.kode')
                ->join('users', 'users.nomor_induk', '=', 'ekskuls.kode_pelatih')
                ->where('data_ekskuls.kode', $nama)
                ->first();
            if ($namapelatih == null) {
                return redirect('/daftar_agenda')->with('success', 'Belum ada peserta');
            } else {

                $data_agenda = Agenda::join('data_ekskuls', 'data_ekskuls.kode', '=', 'agendas.nama_ekskul')
                    ->join('users', 'users.nomor_induk', '=', 'agendas.kode_pelatih')
                    ->where('agendas.nama_ekskul', $nama)
                    ->get(['agendas.*', 'users.name']);

                return view('agenda.agenda', [
                    'dataagenda' => $data_agenda,
                    'nama_ekskul' => $nama,
                    'pelatih' => $namapelatih,
                    'tahun_ajaran' => $tahun_ajaran
                ]);
            }
        } else if (auth()->user()->role == 3) {
            //group tahun ajaran
            $tahun_ajaran = Agenda::groupBy('tahun_ajaran')->distinct()->get();
            //idpelatih
            $namapelatih = DB::table('data_ekskuls')
                ->select(['ekskuls.kode_pelatih as kode_pelatih', 'users.nomor_induk as nama_pelatih'])
                ->join('ekskuls', 'ekskuls.id_data_ekskul', '=', 'data_ekskuls.kode')
                ->join('users', 'users.nomor_induk', '=', 'ekskuls.kode_pelatih')
                ->where('data_ekskuls.kode', $nama)
                ->first();

            if ($namapelatih == null) {
                return redirect('/daftar_agenda')->with('success', 'Belum ada peserta');
            } else {

                $data_agenda = Agenda::join('data_ekskuls', 'data_ekskuls.kode', '=', 'agendas.nama_ekskul')
                    ->join('users', 'users.nomor_induk', '=', 'agendas.kode_pelatih')
                    ->where('agendas.nama_ekskul', $nama)
                    ->get(['agendas.*', 'users.name']);

                return view('agenda.agenda', [
                    'dataagenda' => $data_agenda,
                    'nama_ekskul' => $nama,
                    'pelatih' => $namapelatih,
                    'tahun_ajaran' => $tahun_ajaran
                ]);
            }
        }
    }

    public function edit($id)
    {
        $data_agenda = Agenda::where('id', $id)->first();
        return view('agenda.editagenda', ['dataagenda' => $data_agenda]);
    }

    public function updateagenda(Request $request)
    {
        $update = DB::table('agendas')->where('id', $request->id)->update([
            'tanggal' => $request->tanggal,
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'nama_materi' => $request->nama_materi
        ]);
        if (auth()->user()->role == 2) {
            return redirect("/daftar_agenda")->with('success', 'Update selesai');
        }
        return redirect("/daftar_agenda/$request->nama_ekskul")->with('success', 'Update selesai');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role == 0) {
            $validatedData = $request->validate([
                'tanggal' => ['required'],
                'nama_materi' => ['required'],
                'nama_ekskul' => ['required'],
                'kode_pelatih' => ['required'],
                'tahun_ajaran' => ['required'],
                'semester' => ['required']
            ]);
            setlocale(LC_TIME, 'id_ID');
            Carbon::setLocale('id');
            $bulan = Carbon::parse($request->tanggal)->isoFormat('dddd');
            $validatedData['hari'] = $bulan;
            Agenda::create($validatedData);

            return redirect("/daftar_agenda/$request->nama_ekskul")->with('success', 'Tambah Materi Berhasil');
        } else if (auth()->user()->role == 2) {
            $validatedData = $request->validate([
                'tanggal' => ['required'],
                'nama_materi' => ['required'],
                'nama_ekskul' => ['required'],
                'kode_pelatih' => ['required'],
                'tahun_ajaran' => ['required'],
                'semester' => ['required']
            ]);
            setlocale(LC_TIME, 'id_ID');
            Carbon::setLocale('id');
            $bulan = Carbon::parse($request->tanggal)->isoFormat('dddd');
            $validatedData['hari'] = $bulan;

            Agenda::create($validatedData);
            return redirect(url()->previous())->with('success', 'Tambah Materi berhasil');
        }
    }

    public function destroy($id)
    {
        Agenda::destroy($id);
        return redirect(url()->previous())->with('success', 'Agenda berhasil di hapus ');
    }


    public function daftar_agenda()
    {

        if (auth()->user()->role == 0) {
            $ekskul = InformasiEkskul::join('data_ekskuls', 'data_ekskuls.kode', '=', 'informasi_ekskuls.id_data_ekskul')
                ->get();
            return view('agenda.daftar_agenda', ['agenda' => $ekskul]);
        } else if (auth()->user()->role == 2) {

            //group tahun ajaran
            $tahun_ajaran = Agenda::groupBy('tahun_ajaran')->distinct()->get();

            //nama ekskul
            $nama_ekskul = InformasiEkskul::where('kode_pelatih', auth()->user()->nomor_induk)->first();
            $data_agenda = Agenda::join('data_ekskuls', 'data_ekskuls.kode', '=', 'agendas.nama_ekskul')
                ->join('users', 'users.nomor_induk', '=', 'agendas.kode_pelatih')
                ->where('agendas.kode_pelatih', auth()->user()->nomor_induk)
                ->get(['agendas.*', 'users.name', 'data_ekskuls.nama as ekskul']);
            return view('agenda.agenda', [
                'dataagenda' => $data_agenda,
                'nama_ekskul' => $nama_ekskul->id_data_ekskul,
                'pelatih' => auth()->user()->name,
                'tahun_ajaran' => $tahun_ajaran
            ]);
        } else if (auth()->user()->role == 1) {
            $ekskul = DB::table('ekskuls')
                ->join('data_ekskuls', 'data_ekskuls.kode', '=', 'ekskuls.id_data_ekskul')
                ->where('nomor_induk_siswa', auth()->user()->nomor_induk)
                ->where('is_status', 2)
                ->get();

            return view('agenda.daftar_agenda', ['agenda' => $ekskul]);
        } else if (auth()->user()->role == 3) {
            $ekskul = InformasiEkskul::join('data_ekskuls', 'data_ekskuls.kode', '=', 'informasi_ekskuls.id_data_ekskul')
                ->get();
            return view('agenda.daftar_agenda', ['agenda' => $ekskul]);
        }
    }

    public function cetakpdf_agenda_pelatih(Request $request)
    {
        $nama = $request->input('nama_ekskul');
        //idpelatih
        $namapelatih = DB::table('data_ekskuls')
            ->select(['ekskuls.kode_pelatih as kode_pelatih', 'users.name as nama_pelatih', 'data_ekskuls.*'])
            ->join('ekskuls', 'ekskuls.id_data_ekskul', '=', 'data_ekskuls.kode')
            ->join('users', 'users.nomor_induk', '=', 'ekskuls.kode_pelatih')
            ->where('data_ekskuls.kode', $nama)
            ->first();
        if (auth()->user()->role == 2) {
            $data_agenda = Agenda::join('users', 'users.nomor_induk', '=', 'agendas.kode_pelatih')
                ->where('kode_pelatih', auth()->user()->nomor_induk)
                ->where('nama_ekskul', $nama)
                ->where('tahun_ajaran', $request->input('tahun_ajaran'))
                ->where('semester', $request->input('semester'))
                ->get(['users.name', 'agendas.*']);
            $pdf = PDF::loadview('agenda.agenda_cetakpdf', [
                'agenda' => $data_agenda,
                'nama_ekskul' => $namapelatih->nama,
                'tahun_ajaran' => $request->input('tahun_ajaran'),
                'nama_pelatih' => $namapelatih
            ]);
            return $pdf->stream();
        } else if (auth()->user()->role == 0 || auth()->user()->role == 3) {
            $data_agenda = Agenda::join('users', 'users.nomor_induk', '=', 'agendas.kode_pelatih')
                ->where('nama_ekskul', $nama)
                ->where('tahun_ajaran', $request->input('tahun_ajaran'))
                ->where('semester', $request->input('semester'))
                ->get(['users.name', 'agendas.*']);

            $pdf = PDF::loadview('agenda.agenda_cetakpdf', [
                'agenda' => $data_agenda,
                'nama_ekskul' => $namapelatih->nama,
                'tahun_ajaran' => $request->input('tahun_ajaran'),
                'nama_pelatih' => $namapelatih

            ]);
            return $pdf->stream();
        }
    }
}
