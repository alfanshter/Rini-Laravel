<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Http\Requests\StoreEkskulRequest;
use App\Http\Requests\UpdateEkskulRequest;
use App\Models\DataEkskul;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $pendaftaran_seleksi = Ekskul::join('data_ekskuls','data_ekskuls.kode', '=','ekskuls.kode_ekskul')
        ->join('informasi_ekskuls','informasi_ekskuls.id', '=', 'ekskuls.id_informasi')
        ->join('users','users.nim', '=', 'ekskuls.nim_siswa')
        ->where('ekskuls.kode_pelatih',auth()->user()->nim)
        ->where('ekskuls.is_status',1)
        ->get(['users.name','users.kelas','informasi_ekskuls.*','data_ekskuls.nama as nama_ekskul','ekskuls.*']);
        return view('ekskul.pendaftaran_seleksi',[
            'pendaftaran_seleksi' => $pendaftaran_seleksi
        ]);
    }

    public function register($id)
    {
        $data = DataEkskul::join('informasi_ekskuls', 'informasi_ekskuls.kode_ekskul', '=', 'data_ekskuls.kode')
        ->join('users','users.nim', '=', 'informasi_ekskuls.kode_pelatih')
        ->where('informasi_ekskuls.id',$id)
        ->first(['data_ekskuls.nama','informasi_ekskuls.*','users.name','users.nim']);

        $is_daftar = 0;
        $cekpendaftaran = Ekskul::where('nim_siswa',auth()->user()->nim)->where('id_informasi',$id)->first();
        if ($cekpendaftaran!=null) {
            $is_daftar = $cekpendaftaran->is_status;
        }
        return view('ekskul.pendaftaran',[
            'data_ekskul' => $data,
            'is_daftar' => $is_daftar
        ]);
    }

    public function store(Request $request)
    {
        Ekskul::create($request->all());
        return redirect('/ekskul/pendaftaran/'.+$request->id_informasi)->with('success','Pendaftaran berhasil');

    }

    public function update(Request $request)
    {
        $status= $request->is_status;
        $update = DB::table('ekskuls')->where('id',$request->id)->update([
            'is_status' => $request->is_status
        ]);
        
        if ($status == 2) {
            return redirect('/pendaftaran_seleksi')->with('success','Peserta diterima');

        }
        else if ($status == 3) {
            return redirect('/pendaftaran_seleksi')->with('success','Peserta ditolak');

        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
