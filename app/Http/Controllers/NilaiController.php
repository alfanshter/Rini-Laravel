<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Http\Requests\StoreNilaiRequest;
use App\Http\Requests\UpdateNilaiRequest;
use App\Models\DataEkskul;
use App\Models\Ekskul;
use App\Models\InformasiEkskul;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{

    public function index()
    {
        if (auth()->user()->role ==2) {
            $ekskul = InformasiEkskul::join('data_ekskuls','data_ekskuls.kode', '=','informasi_ekskuls.kode_ekskul')
            ->where('informasi_ekskuls.kode_pelatih',auth()->user()->nim)
            ->get();
        return view('nilai.daftarnilai',['ekskul' =>$ekskul]);    

        }

        else if (auth()->user()->role ==0) {
            $ekskul = InformasiEkskul::join('data_ekskuls','data_ekskuls.kode', '=','informasi_ekskuls.kode_ekskul')
            ->get();
            return view('nilai.daftarnilai',['ekskul' =>$ekskul]);    

        }

        else if (auth()->user()->role ==3 || auth()->user()->role ==4) {
            $ekskul = InformasiEkskul::join('data_ekskuls','data_ekskuls.kode', '=','informasi_ekskuls.kode_ekskul')
            ->get();
            return view('nilai.daftarnilai',['ekskul' =>$ekskul]);    

        }


        else if (auth()->user()->role ==1) {
            $ekskul = DB::table('ekskuls')
                ->join('data_ekskuls','data_ekskuls.kode','=','ekskuls.kode_ekskul')
                ->where('nim_siswa',auth()->user()->nim)
                ->where('is_status',2)
                ->get();
            
        return view('nilai.daftarnilai',['ekskul' =>$ekskul]);    

        }

    }

    public function store(Request $request)
    {
        if (auth()->user()->role ==2) {
            $validatedData = $request->validate([
                'nama_ekskul' => 'required|max:255',
                'id_siswa' => ['required'],
                'nilai' => ['required'],
                'tahun_ajaran' => ['required'],
                'semester' => ['required']
            ]);
    
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
    
            Nilai::create($validatedData);
    
            return redirect("/data_nilai/$request->nama_ekskul")->with('success','Nilai berhasil di input');
    
    
        }

        else if (auth()->user()->role ==0){
            $validatedData = $request->validate([
                'nama_ekskul' => 'required|max:255',
                'id_siswa' => ['required'],
                'nilai' => ['required'],
                'tahun_ajaran' => ['required'],
                'semester' => ['required']
            ]);
    
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
    
            Nilai::create($validatedData);
    
            return redirect("/data_nilai/$request->nama_ekskul")->with('success','Nilai berhasil di input');
    

        }

    }

    public function daftar_nilai($nama_ekskul)
    {
        if (auth()->user()->role ==0) {
             //idpelatih
             $namapelatih = DB::table('data_ekskuls')
             ->select(['ekskuls.kode_pelatih as id_pelatih','users.name as nama_pelatih'])
             ->join('ekskuls','ekskuls.kode_ekskul','=','data_ekskuls.kode')
             ->join('users','users.nim','=','ekskuls.kode_pelatih')
             ->where('data_ekskuls.nama',$nama_ekskul)
             ->first();
             if ($namapelatih == null)
             {
                 return redirect('/nilai')->with('success','Belum ada peserta');
             }
            //nama siswa
            $nama_siswa = Ekskul::join('users','users.nim', '=' ,'ekskuls.nim_siswa')
            ->join('data_ekskuls','data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
            ->where('data_ekskuls.nama',$nama_ekskul)
            ->where('data_ekskuls.nama', $nama_ekskul)
            ->where('is_status', 2)
            ->get(['users.name','users.nim']);
            


            $nilai = DB::table('nilais')
                    ->where('id_pelatih',$namapelatih->id_pelatih)
                    ->where('nama_ekskul', $nama_ekskul)
                    ->get();

                
            return view('nilai.nilai',
                ['nilai' =>$nilai,
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

            $nilai = DB::table('nilais')
                    ->where('id_pelatih', auth()->user()->nim)
                    ->where('nama_ekskul', $nama_ekskul)
                    ->get();
                
            return view('nilai.nilai',
                ['nilai' =>$nilai,
                'nama_siswa' => $nama_siswa,
                'nama_ekskul' => $nama_ekskul
                ]);   
        }
         else if (auth()->user()->role ==1){
            $nilai = DB::table('nilais')
            ->where('id_siswa', auth()->user()->nim)
            ->where('nama_ekskul', $nama_ekskul)
            ->get();

            return view('nilai.nilai',
            ['nilai' =>$nilai            ]);   

        }

        else if (auth()->user()->role ==3 || auth()->user()->role ==4) {
            //idpelatih
            $namapelatih = DB::table('data_ekskuls')
            ->select(['ekskuls.kode_pelatih as id_pelatih','users.name as nama_pelatih'])
            ->join('ekskuls','ekskuls.kode_ekskul','=','data_ekskuls.kode')
            ->join('users','users.nim','=','ekskuls.kode_pelatih')
            ->where('data_ekskuls.nama',$nama_ekskul)
            ->first();
           
            if ($namapelatih == null)
            {
                return redirect('/nilai')->with('success','Belum ada peserta');
            }

           //nama siswa
           $nama_siswa = Ekskul::join('users','users.nim', '=' ,'ekskuls.nim_siswa')
           ->join('data_ekskuls','data_ekskuls.kode', '=', 'ekskuls.kode_ekskul')
           ->where('data_ekskuls.nama',$nama_ekskul)
           ->where('data_ekskuls.nama', $nama_ekskul)
           ->where('is_status', 2)
           ->get(['users.name','users.nim']);
           


           $nilai = DB::table('nilais')
                   ->where('id_pelatih',$namapelatih->id_pelatih)
                   ->where('nama_ekskul', $nama_ekskul)
                   ->get();

               
           return view('nilai.nilai',
               ['nilai' =>$nilai,
               'nama_siswa' => $nama_siswa,
               'namapelatih' => $namapelatih,
               'nama_ekskul' => $nama_ekskul
               ]);   
       }
    }

    public function destroy($id)
    {
            Nilai::destroy($id);
            return redirect('/nilai')->with('success', 'Nilai berhasil di hapus ');            
    }

    public function edit($id)
    {
            $nilai = Nilai::where('id',$id)->first();;
            return view('nilai.edit_nilai',['nilai'=>$nilai]);

    }

    public function update(Request $request)
    {
            $update = DB::table('nilais')->
                where('id',$request->id)->update([
                'tahun_ajaran' => $request->tahun_ajaran,
                'nilai' => $request->nilai
            ]);
    
            return redirect("/data_nilai/$request->nama_ekskul")->with('success','Nilai berhasil di Edit');

    }

    public function cetakpdf_nilai(Request $request)
    {
        $nama_ekskul = $request->input('nama_ekskul');
        
          //idpelatih
          $namapelatih = DB::table('data_ekskuls')
          ->select(['ekskuls.kode_pelatih as id_pelatih','users.name as nama_pelatih'])
          ->join('ekskuls','ekskuls.kode_ekskul','=','data_ekskuls.kode')
          ->join('users','users.nim','=','ekskuls.kode_pelatih')
          ->where('data_ekskuls.nama',$nama_ekskul)
          ->first();

            $nilai = Nilai::where('nama_ekskul',$nama_ekskul)
                    ->select(['nilais.*','users.kelas'])
                    ->join('users','users.nim','=','nilais.id_siswa')
                    ->where('tahun_ajaran',$request->input('tahun_ajaran'))
                    ->where('semester',$request->input('semester'))
                    ->get();

            $pdf = Pdf::loadview('nilai.nilai_cetakpdf',[
                'nilai'=>$nilai        ,
                'tahun_ajaran'=>$request->input('tahun_ajaran'),
                'semester'=>$request->input('semester'),
                'nama_ekskul'=>$nama_ekskul,
                'namapelatih'=>$namapelatih

            ]);
            return $pdf->stream();
    }


}