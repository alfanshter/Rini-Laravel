<?php

namespace App\Http\Controllers;

use App\Models\DataEkskul;
use App\Http\Requests\StoreDataEkskulRequest;
use App\Http\Requests\UpdateDataEkskulRequest;
use Illuminate\Http\Request;

class DataEkskulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ekskul.ekskul',[
            'dataekskul' => DataEkskul::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDataEkskulRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'kode' => ['required','min:3','max:255','unique:data_ekskuls'],
            'nama' => ['required']
        ]);

        DataEkskul::create($validatedData);

        return redirect('/dataekskul')->with('success','Pendaftaran berhasil');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataEkskul  $dataEkskul
     * @return \Illuminate\Http\Response
     */
    public function show(DataEkskul $dataEkskul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataEkskul  $dataEkskul
     * @return \Illuminate\Http\Response
     */
    public function edit(DataEkskul $dataEkskul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDataEkskulRequest  $request
     * @param  \App\Models\DataEkskul  $dataEkskul
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDataEkskulRequest $request, DataEkskul $dataEkskul)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataEkskul  $dataEkskul
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataEkskul $dataEkskul)
    {
        //
    }
}
