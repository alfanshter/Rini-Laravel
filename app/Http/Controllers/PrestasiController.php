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
            $ekskul = InformasiEkskul::join('data_ekskuls','data_ekskuls.kode', '=','informasi_ekskuls.kode_ekskul')
            ->get();
            return view('prestasi.prestasi',['prestasi' =>$ekskul]);    
        }
        else if (auth()->user()->role ==1) {
            $ekskul = DB::table('ekskuls')
                ->join('data_ekskuls','data_ekskuls.kode','=','ekskuls.kode_ekskul')
                ->where('nim_siswa',auth()->user()->nim)
                ->where('is_status',2)
                ->get();

            return view('prestasi.prestasi',['prestasi' =>$ekskul]);    
        }

        else if (auth()->user()->role ==2) {
            $ekskul = InformasiEkskul::join('data_ekskuls','data_ekskuls.kode', '=','informasi_ekskuls.kode_ekskul')
            ->where('informasi_ekskuls.kode_pelatih',auth()->user()->nim)
            ->get();
            return view('prestasi.prestasi',['prestasi' =>$ekskul]);    
        }
    }

    public function daftar_prestasi($nama)
    {
        if (auth()->user()->role ==2) {
            //nama peserta
            $nama_peserta = Ekskul::join('users','users.nim', '=' ,'ekskuls.nim_siswa')
            ->join('data_ekskuls','data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
            ->where('data_ekskuls.kode',$nama)
            ->where('kode_pelatih', auth()->user()->nim)
            ->where('is_status', 2)
            ->get(['users.name','data_ekskuls.kode','users.nim']);
            

           $data_prestasi = Prestasi::where('id_pelatih',auth()->user()->nim)
            ->where('kode_ekskul',$nama)
            ->get();
            
            return view('prestasi.daftar_prestasi',[
                'dataprestasi' => $data_prestasi,
                'nama_peserta' => $nama_peserta,
                'kode_ekskul' => $nama
            ]);
        }
        else if (auth()->user()->role ==1) {
            $data_prestasi = Prestasi::where('kode_ekskul',$nama)->get();
            return view('prestasi.daftar_prestasi',[
                'dataprestasi' => $data_prestasi            ]);
        }
        else if (auth()->user()->role ==0) {
            //idpelatih
            $namapelatih = DB::table('data_ekskuls')
                            ->select(['ekskuls.kode_pelatih as id_pelatih','users.nim as nama_pelatih'])
                            ->join('ekskuls','ekskuls.kode_ekskul','=','data_ekskuls.kode')
                            ->join('users','users.nim','=','ekskuls.kode_pelatih')
                            ->where('data_ekskuls.kode',$nama)
                            ->first();
                            
               if ($namapelatih == null)
                {
                    return redirect('/prestasi')->with('success','Belum ada peserta');
                }
                else {
                //nama peserta
                $nama_peserta = Ekskul::join('users','users.nim', '=' ,'ekskuls.nim_siswa')
                ->join('data_ekskuls','data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
                ->where('data_ekskuls.kode',$nama)
                ->where('data_ekskuls.kode', $nama)
                ->where('is_status', 2)
                ->get(['users.name','data_ekskuls.kode','users.nim']);

                $data_prestasi = Prestasi::where('kode_ekskul',$nama)
                ->get();

                return view('prestasi.daftar_prestasi',[
                    'dataprestasi' => $data_prestasi,
                    'kode_ekskul' => $nama,
                    'nama_peserta' => $nama_peserta,
                    'pelatih' => $namapelatih
                ]);
                }
  
        }


    }

    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'nim' => 'required|max:255',
            'nama_lomba' => ['required'],
            'kode_ekskul' => ['required'],
            'prestasi' => ['required'],
            'nama_pelatih' => ['required'],
            'id_pelatih' => ['required'],
            'tanggal' => ['required']
        ]);

        Prestasi::create($validatedData);

        return redirect("/daftar_prestasi/$request->kode_ekskul")->with('success','Prestasi berhasil di input');


    }

    public function edit($id)
    {  
        $data_prestasi = Prestasi::where('id',$id)->first();
        $data_agenda = Agenda::where('id',$id)->first();
        return view('prestasi.edit_prestasi',['data_prestasi' => $data_prestasi]);

    }

    public function update(Request $request)
    {
        $update = DB::table('prestasis')->where('id',$request->id)->update([
            'nama_lomba' => $request->nama_lomba,
            'prestasi' => $request->prestasi,
            'tanggal' => $request->tanggal
        ]);
        
        return redirect("/daftar_prestasi/$request->kode_ekskul")->with('success','Update data berhasil');
    
    }

    public function destroy($id)
    {
            Prestasi::destroy($id);
            return redirect(url()->previous())->with('success', 'Prestasi berhasil di hapus ');            
    }


}