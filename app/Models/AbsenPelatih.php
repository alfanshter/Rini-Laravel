<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenPelatih extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function users(){
        return $this->belongsTo('App\Models\User');
    }

    //nyambungin ke model User
	function user(){
		return $this->hasOne('App\Models\User');
	}
}