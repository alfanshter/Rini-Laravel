<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Ekskul;
use App\Models\InformasiEkskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    public function index()
    {
        if (auth()->user()->role ==0) {
            $ekskul = InformasiEkskul::join('data_ekskuls','data_ekskuls.kode', '=','informasi_ekskuls.kode_ekskul')
            ->get();
            return view('absen.daftarabsen',['ekskul' =>$ekskul]);    
        }
        else if (auth()->user()->role ==2) {
            $ekskul = InformasiEkskul::join('data_ekskuls','data_ekskuls.kode', '=','informasi_ekskuls.kode_ekskul')
            ->where('informasi_ekskuls.kode_pelatih',auth()->user()->nim)
            ->get();

            return view('absen.daftarabsen',['ekskul' =>$ekskul]);    
        }

   
    }

    public function daftar_absen($nama_ekskul)
    {
        if (auth()->user()->role ==0) {
            //idpelatih
            $namapelatih = DB::table('data_ekskuls')
            ->select(['ekskuls.kode_pelatih as id_pelatih','users.name as nama_pelatih'])
            ->join('ekskuls','ekskuls.kode_ekskul','=','data_ekskuls.kode')
            ->join('users','users.nim','=','ekskuls.kode_pelatih')
            ->where('data_ekskuls.nama',$nama_ekskul)
            ->first();
           
           //nama siswa
           $nama_siswa = Ekskul::join('users','users.nim', '=' ,'ekskuls.nim_siswa')
           ->join('data_ekskuls','data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
           ->where('data_ekskuls.nama',$nama_ekskul)
           ->where('data_ekskuls.nama', $nama_ekskul)
           ->where('is_status', 2)
           ->get(['users.name','users.kelas','users.nim']);
           


           $absen = DB::table('absens')
                    ->select(['absens.*','users.kelas','users.name'])
                   ->join('users','users.nim', '=', 'absens.id_siswa')
                   ->where('id_pelatih',$namapelatih->id_pelatih)
                   ->where('nama_ekskul', $nama_ekskul)
                   ->get();

               
           return view('absen.absen',
               ['absen' =>$absen,
               'nama_siswa' => $nama_siswa,
               'namapelatih' => $namapelatih,
               'nama_ekskul' => $nama_ekskul
               ]);   
       }

       else if (auth()->user()->role ==2) {
        //nama siswa
        $nama_siswa = Ekskul::join('users','users.nim', '=' ,'ekskuls.nim_siswa')
        ->join('data_ekskuls','data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
        ->where('data_ekskuls.nama',$nama_ekskul)
        ->where('kode_pelatih', auth()->user()->nim)
        ->where('is_status', 2)
        ->get(['users.name','users.nim']);

        $absen = DB::table('absens')
                ->select(['absens.*','users.kelas','users.name'])
                ->join('users','users.nim', '=', 'absens.id_siswa')
                ->where('id_pelatih', auth()->user()->nim)
                ->where('nama_ekskul', $nama_ekskul)
                ->get();

            
                return view('absen.absen',
                ['absen' =>$absen,
                'nama_siswa' => $nama_siswa,
                'nama_ekskul' => $nama_ekskul
                ]);   

    }

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_ekskul' => 'required|max:255',
            'id_siswa' => ['required'],
            'absen' => ['required'],
            'tanggal' => ['required'],
            'tahun_ajaran' => ['required'],
            'semester' => ['required']
        ]);

        if (auth()->user()->role ==0) {
            //getid ekskul
            $getekskul = DB::table('data_ekskuls')
            ->where('nama', $request->nama_ekskul)
            ->first();

            //Nama Siswa
            $siswa = DB::table('users')
                ->where('nim', $request->id_siswa)
                ->first();
        
            //Nama Pelatih
            $namapelatih = DB::table('data_ekskuls')
                ->select(['ekskuls.kode_pelatih as id_pelatih','users.name as nama_pelatih'])
                ->join('ekskuls','ekskuls.kode_ekskul','=','data_ekskuls.kode')
                ->join('users','users.nim','=','ekskuls.kode_pelatih')
                ->where('data_ekskuls.nama',$request->nama_ekskul)
                ->first();

            $validatedData['nama_pelatih'] = $namapelatih->nama_pelatih;
            $validatedData['id_pelatih'] = $namapelatih->id_pelatih;
            $validatedData['id_ekskul'] = $getekskul->kode;
            $validatedData['nama_siswa'] = $siswa->name;


            Absen::create($validatedData);
        
            return redirect("/data_absen/$request->nama_ekskul")->with('success','Nilai berhasil di input');

        }
        else if (auth()->user()->role ==2) {
        //getid ekskul
        $getekskul = DB::table('data_ekskuls')
        ->where('nama', $request->nama_ekskul)
        ->first();

        //Nama Siswa
        $siswa = DB::table('users')
            ->where('nim', $request->id_siswa)
            ->first();
    
        $validatedData['nama_pelatih'] = auth()->user()->name;
        $validatedData['id_pelatih'] = auth()->user()->nim;
        $validatedData['id_ekskul'] = $getekskul->kode;
        $validatedData['nama_siswa'] = $siswa->name;


        Absen::create($validatedData);
    
        return redirect("/data_absen/$request->nama_ekskul")->with('success','Nilai berhasil di input');

        }
    }

    public function destroy($id)
    {
        
            Absen::destroy($id);
            return redirect('/absen')->with('success', 'Absen berhasil di hapus ');            
    }

    
    public function edit($id)
    {
            $absen = Absen::where('id',$id)->first();;
            return view('absen.edit_absen',['absen'=>$absen]);

    }

    public function update(Request $request)
    {
           
            $update = DB::table('absens')->
                where('id',$request->id)->update([
                'absen' => $request->absen
            ]);
    
            return redirect("/absen")->with('success','Nilai berhasil di Edit');

    }


}
