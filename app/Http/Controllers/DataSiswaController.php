<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataSiswaController extends Controller
{
    public function index()
    {
        return view('siswa.siswa',[
            'datasiswa' => User::where('role',1)->get()
        ]);

    }

    public function tambahsiswa(Request $request)
    {
        $cekuser = User::where('nim',$request->nim)->first();
        if ($cekuser!=null) {
            return redirect('/datasiswa')->with('failed','NISN sudah terdaftar');
        }
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required','min:3','max:255','unique:users'],
            'alamat' => ['required'],
            'kelas' => ['required'],
            'nim' => ['required','unique:users'],
            'password' => ['required','min:5'],
            'jenis_kelamin' => ['required']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 1;

        User::create($validatedData);

        return redirect('/datasiswa')->with('success','Pendaftaran berhasil');


    }

    public function edit($id)
    {
        return view('siswa.editsiswa',[
            'datasiswa' => User::where('id',$id)->first()
        ]);
    }

    public function biodata()
    {
        $datasiswa = User::where('id',auth()->user()->id)->first();
        return view('siswa.biodata',[
            'datasiswa' => $datasiswa
        ]);   
    }

    public function update(Request $request)
    {
        $rule = [
            'name' => 'required|max:255',
            'alamat' => ['required'],
            'kelas' => ['required'],
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

        return redirect('/datasiswa')->with('success','Update Siswa Berhasil');

    }

    public function updatepassword(Request $request)
    {

        $validatedData = $request->validate([
            'password' => ['required','min:5']
        ]);
        
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::where('id',$request->id)
            ->update($validatedData);

        return redirect('/biodata')->with('success','Update Password Berhasil');

    }
    public function destroy($id)
    {

        User::destroy($id);
        return redirect('/datasiswa')->with('success', 'Siswa berhasil di hapus ');
    }
}