<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    public $timestamps = false;
    use HasFactory;

    // Relación uno a muchos
    public function accesos(){
        return $this->hasMany(Acceso::class);
    }

}
