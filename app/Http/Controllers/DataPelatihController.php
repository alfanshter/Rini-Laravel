<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataPelatihController extends Controller
{
    public function index()
    {
        return view('pelatih.pelatih', [
            'datapelatih' => User::where('role', 2)->get()
        ]);
    }

    public function edit($id)
    {
        return view('pelatih.editpelatih', [
            'datapelatih' => User::where('id', $id)->first()
        ]);
    }

    public function update(Request $request)
    {
        $rule = [
            'name' => 'required|max:255',
            'nohp' => ['required'],
            'nomor_induk' => ['required'],
            'username' => ['required'],
        ];
        //Apakah nomor_induk sama ? 
        $getuser = User::where('id', $request->id)->first();
        if ($request->nomor_induk != $getuser->nomor_induk) {
            //cek kode pelatih
            $cek = User::where('nomor_induk', $request->nomor_induk)->first();
            if ($cek != null) {
                return redirect('/pelatih')->with('failed', 'Kode pelatih sama');
            }
        }

        if ($request->username != $getuser->username) {
            //cek kode pelatih
            $cek = User::where('username', $request->username)->first();
            if ($cek != null) {
                return redirect('/pelatih')->with('failed', 'Username sama');
            }
        }

        $validation = $request->validate($rule);

        //apakah password diisi ?
        if ($request->password) {
            $validation['password'] = Hash::make($request->password);
        }

        User::where('id', $request->id)
            ->update($validation);

        return redirect('/pelatih')->with('success', 'Update Pelatih Berhasil');
    }



    public function tambahpelatih(Request $request)
    {
        $cekuser = User::where('nomor_induk', $request->nomor_induk)->first();
        if ($cekuser != null) {
            return redirect('/pelatih')->with('failed', 'Kode Pelatih sudah terdaftar');
        }
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'nohp' => ['required'],
            'nomor_induk' => ['required', 'unique:users'],
            'password' => ['required', 'min:5'],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 2;

        User::create($validatedData);

        return redirect('/pelatih')->with('success', 'Pendaftaran berhasil');
    }

    public function updatepassword(Request $request)
    {

        $validatedData = $request->validate([
            'nohp' => ['required']
        ]);

        if ($request->password_lama && $request->password) {
            //cek password lama
            //Apakah nomor_induk sama ? 
            $getuser = User::where('id', $request->id)->first();
            $password_lama = $request->password_lama;
            if (!Hash::check($password_lama, $getuser->password)) {
                return redirect('/biodata_pelatih')->with('error', 'Password lama salah');
            }
            $validatedData['password'] = Hash::make($request->password);

            User::where('id', $request->id)
                ->update($validatedData);


            return redirect('/biodata_pelatih')->with('success', 'Update Biodata Berhasil');
        } else {
            User::where('id', $request->id)
                ->update($validatedData);
            return redirect('/biodata_pelatih')->with('success', 'Update Biodata Berhasil');
        }
    }

    public function biodata_pelatih()
    {
        $datapelatih = User::where('id', auth()->user()->id)->first();
        return view('pelatih.biodata_pelatih', [
            'datapelatih' => $datapelatih
        ]);
    }

    public function destroy($id)
    {

        User::destroy($id);
        return redirect('/pelatih')->with('success', 'Pelatih berhasil di hapus ');
    }
}
