<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataPelatihController extends Controller
{
    public function index()
    {
        return view('pelatih.pelatih',[
            'datapelatih' => User::where('role',2)->get()
        ]);
    }

    public function edit($id)
    {
        return view('pelatih.editpelatih',[
            'datapelatih' => User::where('id',$id)->first()
        ]);
    }

    public function update(Request $request)
    {
        $rule = [
            'name' => 'required|max:255',
            'alamat' => ['required'],
            'nohp' => ['required'],
            'nim' => ['required'],
            'username' => ['required'],
        ];
        //Apakah Nim sama ? 
        $getuser = User::where('id',$request->id)->first();
        if ($request->nim !=$getuser->nim) {
            $rule['nim'] = 'required|unique:users';
        }

        if ($request->username !=$getuser->username) {
            $rule['username'] = 'required|unique:users';
        }

        $validation = $request->validate($rule);

        User::where('id',$request->id)
            ->update($validation);

        return redirect('/pelatih')->with('success','Update Pelatih Berhasil');

    }



    public function tambahpelatih(Request $request)
    {
        $cekuser = User::where('nim',$request->nim)->first();
        if ($cekuser!=null) {
            return redirect('/pelatih')->with('failed','Kode Pelatih sudah terdaftar');
        }
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required','min:3','max:255','unique:users'],
            'alamat' => ['required'],
            'nohp' => ['required'],
            'nim' => ['required','unique:users'],
            'password' => ['required','min:5'],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 2;

        User::create($validatedData);

        return redirect('/pelatih')->with('success','Pendaftaran berhasil');


    }

    public function updatepassword(Request $request)
    {

        $validatedData = $request->validate([
            'password' => ['required','min:5']
        ]);
        
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::where('id',$request->id)
            ->update($validatedData);

        return redirect('/biodata_pelatih')->with('success','Update Password Berhasil');

    }

    public function biodata_pelatih()
    {
        $datapelatih = User::where('id',auth()->user()->id)->first();
        return view('pelatih.biodata_pelatih',[
            'datapelatih' => $datapelatih
        ]);   
    }

    public function destroy($id)
    {

        User::destroy($id);
            return redirect('/pelatih')->with('success', 'Pelatih berhasil di hapus ');
    }


}