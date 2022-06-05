<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiEkskul extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function informasiekskul_to_users()
    {
        return $this->belongsTo(User::class,'kode_pelatih','nomor_induk');
    }
}
