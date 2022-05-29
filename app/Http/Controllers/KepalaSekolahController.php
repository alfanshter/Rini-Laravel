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

        $cekuser = User::where('nomor_induk', $request->nomor_induk)->first();
        if ($cekuser != null) {
            return redirect('/kepalasekolah')->with('failed', 'Kode Kepala Sekolah sudah terdaftar');
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'nohp' => ['required'],
            'nomor_induk' => ['required', 'unique:users'],
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

            'nomor_induk' => ['required'],
            'username' => ['required'],
        ];
        //Apakah nomor_induk sama ? 
        $getuser = User::where('id', $request->id)->first();
        if ($request->nomor_induk != $getuser->nomor_induk) {
            //cek kode Kepala sekolah
            $cek = User::where('nomor_induk', $request->nomor_induk)->first();
            if ($cek != null) {
                return redirect('/kepalasekolah')->with('failed', 'Kode kepala sekolah sama');
            }
        }

        if ($request->username != $getuser->username) {
            $cek = User::where('username', $request->username)->first();
            if ($cek != null) {
                if (auth()->user()->role == 3) {
                    $id = auth()->user()->id;
                    return redirect("/kepalasekolah/editkepalasekolah/$id")->with('failed', 'Username Sama');
                }
                return redirect('/kepalasekolah')->with('failed', 'Username sama');
            }
        }

        $validation = $request->validate($rule);
        if ($request->password_lama && $request->password) {
            //cek password lama
            //Apakah nomor_induk sama ? 
            $getuser = User::where('id', $request->id)->first();
            $password_lama = $request->password_lama;
            if (!Hash::check($password_lama, $getuser->password)) {
                if (auth()->user()->role == 3) {
                    $id = auth()->user()->id;
                    return redirect("/kepalasekolah/editkepalasekolah/$id")->with('failed', 'Password lama salah');
                }
                return redirect('/kepalasekolah')->with('failed', 'Password lama salah');
            }
            $validation['password'] = Hash::make($request->password);
            User::where('id', $request->id)
                ->update($validation);


            if (auth()->user()->role == 3) {
                $id = auth()->user()->id;
                return redirect("/kepalasekolah/editkepalasekolah/$id")->with('success', 'Update Kepala Sekolah Berhasil');
            }
            return redirect('/kepalasekolah')->with('success', 'Update Kepala Sekolah Berhasil');
        }
        User::where('id', $request->id)
            ->update($validation);

        if (auth()->user()->role == 3) {
            $id = auth()->user()->id;
            return redirect("/kepalasekolah/editkepalasekolah/$id")->with('success', 'Update Kepala Sekolah Berhasil');
        }
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
        return redirect(redirect()->getUrlGenerator()->previous())->with('success', 'Update Password Berhasil');
    }
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/kepalasekolah')->with('success', 'Kepala Sekolah berhasil di hapus ');
    }
}
