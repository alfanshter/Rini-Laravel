<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KepalaSekolahController extends Controller
{
    public function index()
    {
        return view('kepalasekolah.kepalasekolah', [
            'kepalasekolah' => User::where('role', 3)->get()
        ]);
    }

    public function tambahkepalasekolah(Request $request)
    {

        $cekuser = User::where('nim', $request->nim)->first();
        if ($cekuser != null) {
            return redirect('/kepalasekolah')->with('failed', 'Kode Kepala Sekolah sudah terdaftar');
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'alamat' => ['required'],
            'nohp' => ['required'],
            'nim' => ['required', 'unique:users'],
            'password' => ['required', 'min:5']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 3;

        User::create($validatedData);

        return redirect('/kepalasekolah')->with('success', 'Pendaftaran berhasil');
    }

    public function edit($id)
    {
        return view('kepalasekolah.editkepalasekolah', [
            'kepalasekolah' => User::where('id', $id)->first()
        ]);
    }

    public function biodata()
    {
        $kepalasekolah = User::where('id', auth()->user()->id)->first();
        return view('kepalasekolah.biodata', [
            'kepalasekolah' => $kepalasekolah
        ]);
    }

    public function update(Request $request)
    {
        $rule = [
            'name' => 'required|max:255',
            'nohp' => ['required'],
            'alamat' => ['required'],
            'nim' => ['required'],
            'username' => ['required'],
        ];
        //Apakah Nim sama ? 
        $getuser = User::where('id', $request->id)->first();
        if ($request->nim != $getuser->nim) {
            //cek kode Kepala sekolah
            $cek = User::where('nim', $request->nim)->first();
            if ($cek != null) {
                return redirect('/kepalasekolah')->with('failed', 'Kode kepala sekolah sama');
            }
        }

        if ($request->username != $getuser->username) {
            $cek = User::where('username', $request->username)->first();
            if ($cek != null) {
                return redirect('/kepalasekolah')->with('failed', 'Username sama');
            }
        }

        $validation = $request->validate($rule);
        if ($request->password) {
            $validation['password'] = Hash::make($request->password);
        }
        User::where('id', $request->id)
            ->update($validation);

        return redirect('/kepalasekolah')->with('success', 'Update Kepala Sekolah Berhasil');
    }

    public function updatepassword(Request $request)
    {

        $validatedData = $request->validate([
            'password' => ['required', 'min:5']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::where('id', $request->id)
            ->update($validatedData);

        return redirect('/biodata')->with('success', 'Update Password Berhasil');
    }
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/kepalasekolah')->with('success', 'Kepala Sekolah berhasil di hapus ');
    }
}
