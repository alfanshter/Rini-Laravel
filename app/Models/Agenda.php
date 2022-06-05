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
        return $this->belongsTo(Ekskul::class, 'kode_pelatih', 'kode_pelatih');
    }

    public function users()
    {
        return $this->belongsTo(Users::class, 'kode_pelatih', 'nomor_induk');
    }

    public function data_ekskul()
    {
        return $this->belongsTo(DataEkskul::class, 'nama_ekskul', 'kode');
    }

    public function agenda_to_ekskul()
    {
        return $this->belongsTo(DataEkskul::class, 'id_data_ekskul', 'kode');
    }
}
