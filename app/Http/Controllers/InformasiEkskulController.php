<?php

namespace App\Http\Controllers;

use App\Models\DataEkskul;
use App\Models\InformasiEkskul;
use Illuminate\Http\Request;

class InformasiEkskulController extends Controller
{
    public function index()
    {
        $get_data_ekskul = DataEkskul::all();
        return view('informasiekskul.informasiekskul',[
            'informasiekskul' => InformasiEkskul::all(),
            'data_ekskul' => $get_data_ekskul
        ]);

    }
}
