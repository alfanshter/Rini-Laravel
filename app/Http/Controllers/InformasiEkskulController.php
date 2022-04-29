<?php

namespace App\Http\Controllers;

use App\Models\DataEkskul;
use App\Models\Ekskul;
use App\Models\InformasiEkskul;
use App\Models\User;
use Illuminate\Http\Request;

class InformasiEkskulController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 1) {
            $get_data_ekskul = DataEkskul::all();
            $data = DataEkskul::join('informasi_ekskuls', 'informasi_ekskuls.kode_ekskul', '=', 'data_ekskuls.kode')
                                ->join('users','users.nim', '=', 'informasi_ekskuls.kode_pelatih')
                                ->get(['data_ekskuls.nama','informasi_ekskuls.*','users.name']);
                    
            return view('informasiekskul.informasiekskul',[
                'informasiekskul' => $data,
                'data_ekskul' => $get_data_ekskul,
                'data_pelatih' => User::where('role',2)->get()
            ]);
    
        }else if (auth()->user()->role == 0) {
            $get_data_ekskul = DataEkskul::all();
            $data = DataEkskul::join('informasi_ekskuls', 'informasi_ekskuls.kode_ekskul', '=', 'data_ekskuls.kode')
                                ->join('users','users.nim', '=', 'informasi_ekskuls.kode_pelatih')
                                ->get(['data_ekskuls.nama','informasi_ekskuls.*','users.name']);
            return view('informasiekskul.informasiekskul',[
                'informasiekskul' => $data,
                'data_ekskul' => $get_data_ekskul,
                'data_pelatih' => User::where('role',2)->get()
            ]);
    
        }

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_ekskul' => 'required|max:255',
            'jadwal' => ['required'],
            'jam' => ['required'],
            'tempat_ekskul' => ['required'],
            'kode_pelatih' => ['required']
        ]);

        //cekekskul
        $cek = InformasiEkskul::where('kode_ekskul',$request->kode_ekskul)
                                ->where('kode_pelatih',$request->kode_pelatih)
                                ->first();
        if ($cek) {
            return redirect('/informasiekskul')->with('failed','sudah ada pelatihnya');
        }
        InformasiEkskul::create($validatedData);

        return redirect('/informasiekskul')->with('success','Tambah Data berhasil');

    }

    public function edit($id)
    {  

        $data = DataEkskul::join('informasi_ekskuls', 'informasi_ekskuls.kode_ekskul', '=', 'data_ekskuls.kode')
        ->join('users','users.nim', '=', 'informasi_ekskuls.kode_pelatih')
        ->where('informasi_ekskuls.id',$id)
        ->first(['data_ekskuls.nama','informasi_ekskuls.*','users.name','users.nim']);
        return view('informasiekskul.editinformasiekskul',[
            'data_ekskul' => $data,
            'ekskul' => DataEkskul::all(),
            'data_pelatih' => User::where('role',2)->get()

        ]);
    }

    public function update(Request $request)
    {
        $rule = [
            'kode_ekskul' => 'required|max:255',
            'jadwal' => ['required'],
            'jam' => ['required'],
            'tempat_ekskul' => ['required'],
            'kode_pelatih' => ['required'],
        ];

        $validation = $request->validate($rule);

        InformasiEkskul::where('id',$request->id)
            ->update($validation);

        return redirect('/informasiekskul')->with('success','Update Informasi Ekskul Berhasil');

    }

    public function destroy($id)
    {
        InformasiEkskul::destroy($id);
        return redirect('/informasiekskul')->with('success', 'Informasi Ekskul berhasil di hapus ');
    }

}