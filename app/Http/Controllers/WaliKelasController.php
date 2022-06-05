<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WaliKelasController extends Controller
{
    public function index()
    {
        return view('walikelas.walikelas', [
            'walikelas' => User::where('role', 4)->get()
        ]);
    }

    public function tambahwalikelas(Request $request)
    {
        $cekuser = User::where('nomor_induk', $request->nomor_induk)->first();
        if ($cekuser != null) {
            return redirect('/walikelas')->with('failed', 'Kode Wali Kelas sudah terdaftar');
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],

            'nohp' => ['required'],
            'nomor_induk' => ['required', 'unique:users'],
            'password' => ['required', 'min:5']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 4;

        User::create($validatedData);

        return redirect('/walikelas')->with('success', 'Pendaftaran berhasil');
    }

    public function edit($id)
    {
        return view('walikelas.editwalikelas', [
            'walikelas' => User::where('id', $id)->first()
        ]);
    }

    public function biodata()
    {
        $walikelas = User::where('id', auth()->user()->id)->first();
        return view('walikelas.biodata', [
            'walikelas' => $walikelas
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
            //cek kode Wali kelas
            $cek = User::where('nomor_induk', $request->nomor_induk)->first();
            if ($cek != null) {
                return redirect('/walikelas')->with('failed', 'Kode Wali Kelas sama');
            }
        }

        if ($request->username != $getuser->username) {
            $cek = User::where('username', $request->username)->first();
            if ($cek != null) {
                if (auth()->user()->role == 4) {
                    $id = auth()->user()->id;
                    return redirect("/walikelas/editwalikelas/$id")->with('failed', 'Username sama');
                }
                return redirect('/walikelas')->with('failed', 'Username sama');
            }
        }

        $validation = $request->validate($rule);

        if ($request->password_lama && $request->password) {
            //cek password lama
            //Apakah nomor_induk sama ? 
            $getuser = User::where('id', $request->id)->first();
            $password_lama = $request->password_lama;
            if (!Hash::check($password_lama, $getuser->password)) {
                if (auth()->user()->role == 4) {
                    $id = auth()->user()->id;
                    return redirect("/walikelas/editwalikelas/$id")->with('failed', 'Password lama salah');
                }
                return redirect('/walikelas')->with('failed', 'Password lama salah');
            }
            $validation['password'] = Hash::make($request->password);
            User::where('id', $request->id)
                ->update($validation);


            if (auth()->user()->role == 4) {
                $id = auth()->user()->id;
                return redirect("/walikelas/editwalikelas/$id")->with('success', 'Update Wali Kelas Berhasil');
            }
            return redirect('/walikelas')->with('success', 'Update Wali Kelas Berhasil');
        }elseif ($request->password) {
            $validation['password'] = Hash::make($request->password);
            User::where('id', $request->id)
                ->update($validation);

            if (auth()->user()->role == 4) {
                $id = auth()->user()->id;
                return redirect("/walikelas/editwalikelas/$id")->with('success', 'Update Wali Kelas Berhasil');
            }
            return redirect('/walikelas')->with('success', 'Update Wali Kelas Berhasil');

        }

        User::where('id', $request->id)
            ->update($validation);

        if (auth()->user()->role == 4) {
            $id = auth()->user()->id;
            return redirect("/walikelas/editwalikelas/$id")->with('success', 'Update Wali Kelas Berhasil');
        }
        return redirect('/walikelas')->with('success', 'Update Wali Kelas Berhasil');
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
        return redirect('/walikelas')->with('success', 'Wali Kelas berhasil di hapus ');
    }
}
