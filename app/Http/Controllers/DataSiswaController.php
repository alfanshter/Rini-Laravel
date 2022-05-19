<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataSiswaController extends Controller
{
    public function index()
    {
        return view('siswa.siswa', [
            'datasiswa' => User::where('role', 1)->get()
        ]);
    }

    public function tambahsiswa(Request $request)
    {
        $cekuser = User::where('nomor_induk', $request->nomor_induk)->first();
        if ($cekuser != null) {
            return redirect('/datasiswa')->with('failed', 'NISN sudah terdaftar');
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'kelas' => ['required'],
            'nomor_induk' => ['required', 'unique:users'],
            'password' => ['required', 'min:5'],
            'jenis_kelamin' => ['required'],
            'nohp' => ['required']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 1;

        User::create($validatedData);

        return redirect('/datasiswa')->with('success', 'Pendaftaran berhasil');
    }

    public function edit($id)
    {
        return view('siswa.editsiswa', [
            'datasiswa' => User::where('id', $id)->first()
        ]);
    }

    public function biodata()
    {
        $datasiswa = User::where('id', auth()->user()->id)->first();
        return view('siswa.biodata', [
            'datasiswa' => $datasiswa
        ]);
    }

    public function update(Request $request)
    {
        $rule = [
            'name' => 'required|max:255',
            'kelas' => ['required'],
            'nomor_induk' => ['required'],
            'username' => ['required'],
            'jenis_kelamin' => ['required'],
            'nohp' => ['required']
        ];
        //Apakah nomor_induk sama ? 
        $getuser = User::where('id', $request->id)->first();
        if ($request->nomor_induk != $getuser->nomor_induk) {
            $rule['nomor_induk'] = 'required|unique:users';
        }

        if ($request->username != $getuser->username) {
            $rule['username'] = 'required|unique:users';
        }

        $validation = $request->validate($rule);


        if ($request->password) {
            $validation['password'] = Hash::make($request->password);
        }

        User::where('id', $request->id)
            ->update($validation);

        return redirect('/datasiswa')->with('success', 'Update Siswa Berhasil');
    }

    public function updatepassword(Request $request)
    {


        $validatedData = $request->validate([
            'kelas' => ['required']
        ]);

        if ($request->password_lama && $request->password) {
            //cek password lama
            //Apakah nomor_induk sama ? 
            $getuser = User::where('id', $request->id)->first();
            $password_lama = $request->password_lama;
            if (!Hash::check($password_lama, $getuser->password)) {
                return redirect('/biodata')->with('error', 'Password lama salah');
            }
            $validatedData['password'] = Hash::make($request->password);

            User::where('id', $request->id)
                ->update($validatedData);


            return redirect('/biodata')->with('success', 'Update Biodata Berhasil');
        } else {
            User::where('id', $request->id)
                ->update($validatedData);
            return redirect('/biodata')->with('success', 'Update Biodata Berhasil');
        }
    }
    public function destroy($id)
    {

        User::destroy($id);
        return redirect('/datasiswa')->with('success', 'Siswa berhasil di hapus ');
    }
}
