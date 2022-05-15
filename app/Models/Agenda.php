<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class, 'id_pelatih', 'kode_pelatih');
    }

    public function users()
    {
        return $this->belongsTo(Users::class, 'id_pelatih', 'nomor_induk');
    }

    public function data_ekskul()
    {
        return $this->belongsTo(DataEkskul::class, 'nama_ekskul', 'kode');
    }
}
