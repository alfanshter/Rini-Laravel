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
        
        if (auth()->user()->role ==2) {
    
           $data_agenda = Agenda::join('users','users.nim','=','agendas.id_pelatih')
            ->where('id_pelatih',auth()->user()->nim)
            ->where('nama_ekskul',$nama)
            ->get(['users.name','agendas.*']);
  
                return view('agenda.agenda',[
                    'dataagenda' => $data_agenda,
                    'nama_ekskul' => $nama
                ]);
                    
            
            
        }
        else if (auth()->user()->role ==1) {
            $data_agenda = Ekskul::join('agendas','agendas.id_pelatih','=','ekskuls.kode_pelatih')
            ->join('users','users.nim','=','agendas.id_pelatih')
            ->where('agendas.nama_ekskul',$nama)
            ->where('nim_siswa',auth()->user()->nim)
            ->where('is_status',2)
            ->get();
            return view('agenda.agenda',[
                'dataagenda' => $data_agenda
            ]);
        }
        else if (auth()->user()->role ==0) {
                 //idpelatih

            $namapelatih = DB::table('data_ekskuls')
                            ->select(['ekskuls.kode_pelatih as id_pelatih','users.nim as nama_pelatih'])
                            ->join('ekskuls','ekskuls.kode_ekskul','=','data_ekskuls.kode')
                            ->join('users','users.nim','=','ekskuls.kode_pelatih')
                            ->where('data_ekskuls.nama',$nama)
                            ->first();
            if ($namapelatih == null) {
                return redirect('/daftar_agenda')->with('success','Belum ada peserta');
            }else{

                $data_agenda = Agenda::join('data_ekskuls','data_ekskuls.nama','=','agendas.nama_ekskul')
                ->join('users','users.nim','=','agendas.id_pelatih')
                ->where('agendas.nama_ekskul',$nama)
                ->get(['agendas.*','users.name']);
                return view('agenda.agenda',[
                    'dataagenda' => $data_agenda,
                    'nama_ekskul' => $nama,
                    'pelatih' => $namapelatih
                ]);
            }
            
        }

        else if (auth()->user()->role ==3) {
            $namapelatih = DB::table('data_ekskuls')
                        ->select(['ekskuls.kode_pelatih as id_pelatih','users.nim as nama_pelatih'])
                        ->join('ekskuls','ekskuls.kode_ekskul','=','data_ekskuls.kode')
                        ->join('users','users.nim','=','ekskuls.kode_pelatih')
                        ->where('data_ekskuls.nama',$nama)
                        ->first();
            if ($namapelatih == null) {
            return redirect('/daftar_agenda')->with('success','Belum ada peserta');
            }else{

            $data_agenda = Agenda::join('data_ekskuls','data_ekskuls.nama','=','agendas.nama_ekskul')
            ->join('users','users.nim','=','agendas.id_pelatih')
            ->where('agendas.nama_ekskul',$nama)
            ->get(['agendas.*','users.name']);
            return view('agenda.agenda',[
                'dataagenda' => $data_agenda,
                'nama_ekskul' => $nama,
                'pelatih' => $namapelatih
            ]);
            }

        }



    }

    public function edit($id)
    {  
        $data_agenda = Agenda::where('id',$id)->first();
        return view('agenda.editagenda',['dataagenda'=> $data_agenda]);
    }

    public function updateagenda(Request $request)
    {
        $update = DB::table('agendas')->where('id',$request->id)->update([
            'tanggal' => $request->tanggal,
            'nama_materi' => $request->nama_materi]);

        return redirect("/daftar_agenda/$request->nama_ekskul")->with('success','Update selesai');
    
    }

    public function store(Request $request)
    {
        if (auth()->user()->role ==0) {
            $validatedData = $request->validate([
                'tanggal' => ['required'],
                'nama_materi' => ['required'],
                'nama_ekskul' => ['required'],
                'id_pelatih' => ['required']
            ]);
            setlocale(LC_TIME, 'id_ID');
            Carbon::setLocale('id');
            $bulan = Carbon::parse($request->tanggal)->isoFormat('dddd');
            $validatedData['hari'] = $bulan;
            Agenda::create($validatedData);
    
            return redirect("/daftar_agenda/$request->nama_ekskul")->with('success','Tambah Materi Berhasil');
    
        } 
        else if (auth()->user()->role ==2) {
            $validatedData = $request->validate([
                'tanggal' => ['required'],
                'nama_materi' => ['required'],
                'nama_ekskul' => ['required'],
                'id_pelatih' => ['required']
            ]);
            setlocale(LC_TIME, 'id_ID');
            Carbon::setLocale('id');
            $bulan = Carbon::parse($request->tanggal)->isoFormat('dddd');
            $validatedData['hari'] = $bulan;

            Agenda::create($validatedData);
    
            return redirect("/daftar_agenda/$request->nama_ekskul")->with('success','Tambah Materi Berhasil');
    
        } 
    }

    public function destroy($id)
    {
        Agenda::destroy($id);
        return redirect('/daftar_agenda')->with('success', 'AgendaS berhasil di hapus ');            

    }

    
    public function daftar_agenda()
    {

        if (auth()->user()->role ==0) {
            $ekskul = InformasiEkskul::join('data_ekskuls','data_ekskuls.kode', '=','informasi_ekskuls.kode_ekskul')
            ->get();
            return view('agenda.daftar_agenda',['agenda' =>$ekskul]);    
        }
        else if (auth()->user()->role ==2) {
            $ekskul = InformasiEkskul::join('data_ekskuls','data_ekskuls.kode', '=','informasi_ekskuls.kode_ekskul')
            ->where('informasi_ekskuls.kode_pelatih',auth()->user()->nim)
            ->get();
            return view('agenda.daftar_agenda',['agenda' =>$ekskul]);    
        }
        else if (auth()->user()->role ==1) {
            $ekskul = DB::table('ekskuls')
                ->join('data_ekskuls','data_ekskuls.kode','=','ekskuls.kode_ekskul')
                ->where('nim_siswa',auth()->user()->nim)
                ->where('is_status',2)
                ->get();
            
            return view('agenda.daftar_agenda',['agenda' =>$ekskul]);    
        }

        else if (auth()->user()->role ==3) {
            $ekskul = InformasiEkskul::join('data_ekskuls','data_ekskuls.kode', '=','informasi_ekskuls.kode_ekskul')
            ->get();
            return view('agenda.daftar_agenda',['agenda' =>$ekskul]);    
        }


    }

    public function cetakpdf_agenda_pelatih($nama)
    {
        if (auth()->user()->role == 2) {
            $data_agenda = Agenda::join('users','users.nim','=','agendas.id_pelatih')
            ->where('id_pelatih',auth()->user()->nim)
            ->where('nama_ekskul',$nama)
            ->get(['users.name','agendas.*']);
    
            $pdf = PDF::loadview('agenda.agenda_cetakpdf',[
                'agenda'=>$data_agenda        
            ]);
            return $pdf->stream();
        }else if (auth()->user()->role == 0 || auth()->user()->role == 3) {
            $data_agenda = Agenda::join('users','users.nim','=','agendas.id_pelatih')
            ->where('nama_ekskul',$nama)
            ->get(['users.name','agendas.*']);
    
            $pdf = PDF::loadview('agenda.agenda_cetakpdf',[
                'agenda'=>$data_agenda        
            ]);
            return $pdf->stream();

        }

    }
    

}
