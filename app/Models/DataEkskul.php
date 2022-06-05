<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataEkskul extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ekskul_to_informasiekskul()
    {
        return $this->belongsTo(InformasiEkskul::class, 'kode', 'id_data_ekskul')->with('informasiekskul_to_users');
    }
}
