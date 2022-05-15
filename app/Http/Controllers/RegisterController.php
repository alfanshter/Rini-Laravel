<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'nomor_induk' => ['required'],
            'password' => ['required', 'min:5'],
        ]);

        //cek nik
        $cekuser = User::where('nomor_induk', $request->nomor_induk)->first();
        if ($cekuser != null) {
            return redirect('/register')->with('failed', 'Kode Admin sudah terdaftar');
        }

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 0;
        User::create($validatedData);

        return redirect('/login')->with('success', 'Pendaftaran berhasil');
    }
}
