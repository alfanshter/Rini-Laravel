<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $getdata= Pengumuman::all();
        return view('pengumuman.pengumuman',['pengumuman'=> $getdata]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'keterangan' => 'required',
            'nama_pengumuman' => ['required'],
            "file_pdf" => "required|mimetypes:application/pdf|max:10000"
        ]);

        if ($request->file('file_pdf')) {
            $validatedData['file_pdf'] = $request->file('file_pdf')->store('pengumuman-pdf');
        }
        
        $post =  DB::table('pengumumen')->insert($validatedData);
        return redirect('/pengumuman')->with('success', 'Pengumuman berhasil di input');
    }

    public function edit($id)
    {  
        if (auth()->user()->role ==0) {

            $pengumuman = Pengumuman::where('id',$id)->first();
            return view('pengumuman.editpengumuman',['pengumuman' => $pengumuman]);
    
        }
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'keterangan' => 'required',
            'nama_pengumuman' => ['required']        ]);


        if ($request->file('file_pdf')) {
            if ($request->oldPdf) {
                Storage::delete($request->oldPdf);
            }
            $validatedData['file_pdf'] = $request->file('file_pdf')->store('pengumuman-pdf');
        }

            Pengumuman::where('id',$request->id)
                ->update($validatedData);
            
                return redirect('/pengumuman')->with('success', 'Pengumuman berhasil di update');

    }

    public function delete(Request $request)
    {
        $delete = Pengumuman::where('id',$request->id)->delete();
        Storage::delete($request->file_pdf);
        return redirect('/pengumuman')->with('success','Berhasil di hapus');
    }
    
}
