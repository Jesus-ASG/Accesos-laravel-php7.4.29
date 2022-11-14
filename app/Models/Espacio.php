<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espacio extends Model
{
    use HasFactory;

    // Relación uno a muchos
    public function accesos(){
        return $this->hasMany(Acceso::class);
    }
}
