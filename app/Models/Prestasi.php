<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'nomor_induk', 'nomor_induk');
    }

    public function ekskul()
    {
        return $this->belongsTo(DataEkskul::class, 'kode_ekskul', 'kode');
    }
}
